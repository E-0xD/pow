<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class ProjectsSection extends Component
{
    use WithFileUploads;

    public Portfolio $portfolio;
    public $projects = [];
    public $projectSkillSearch = [];

    protected $rules = [
        'projects.*.title' => 'required|string|max:255',
        'projects.*.brief_description' => 'required|string|max:500',
        'projects.*.project_link' => 'nullable|url|max:255',
        'projects.*.thumbnail' => 'nullable|image|max:1024',
        'projects.*.skills' => 'required|array|min:1',
        'projects.*.skills.*' => 'exists:skills,id'
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        if ($this->portfolio->projects) {
            $this->projects = $this->portfolio->projects->map(function ($proj) {
                return [
                    'id' => $proj->id,
                    'title' => $proj->title,
                    'brief_description' => $proj->brief_description,
                    'project_link' => $proj->project_link,
                    'thumbnail' => null,
                    'skills' => $proj->skills->pluck('id')->toArray()
                ];
            })->toArray();
        }
    }

    public function addProject()
    {
        $this->projects[] = [
            'title' => '',
            'brief_description' => '',
            'project_link' => '',
            'thumbnail' => null,
            'skills' => []
        ];
    }

    public function removeProject($index)
    {
        try {
            DB::beginTransaction();
            
            if (isset($this->projects[$index]['id'])) {
                $this->portfolio->projects()->where('id', $this->projects[$index]['id'])->delete();
            }
            
            unset($this->projects[$index]);
            $this->projects = array_values($this->projects);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete project.');
        }
    }

    public function addProjectSkill($projectIndex)
    {
        if (!empty($this->projectSkillSearch[$projectIndex])) {
            if (!isset($this->projects[$projectIndex]['skills'])) {
                $this->projects[$projectIndex]['skills'] = [];
            }

            if (!in_array($this->projectSkillSearch[$projectIndex], $this->projects[$projectIndex]['skills'])) {
                $this->projects[$projectIndex]['skills'][] = $this->projectSkillSearch[$projectIndex];
            }

            $this->projectSkillSearch[$projectIndex] = '';
        }
    }

    public function removeProjectSkill($projectIndex, $skillIndex)
    {
        if (isset($this->projects[$projectIndex]['skills'][$skillIndex])) {
            unset($this->projects[$projectIndex]['skills'][$skillIndex]);
            $this->projects[$projectIndex]['skills'] = array_values($this->projects[$projectIndex]['skills']);
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            
            foreach ($this->projects as $project) {
                $projectData = [
                    'title' => $project['title'],
                    'brief_description' => $project['brief_description'],
                    'project_link' => $project['project_link'],
                ];

                if (isset($project['id'])) {
                    $projectModel = $this->portfolio->projects()->where('id', $project['id'])->first();
                    $projectModel->update($projectData);
                } else {
                    $projectModel = $this->portfolio->projects()->create($projectData);
                }

                if (!empty($project['thumbnail'])) {
                    $path = $project['thumbnail']->store('public/portfolios/' . $this->portfolio->id . '/projects');
                    $projectModel->update(['thumbnail' => $path]);
                }

                $projectModel->skills()->sync($project['skills']);
            }
            
            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save projects.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.projects-section', [
            'availableSkills' => Skill::all()
        ]);
    }
}