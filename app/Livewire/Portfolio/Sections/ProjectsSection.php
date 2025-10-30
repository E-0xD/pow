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
    public $projectForm = [
        'title' => '',
        'brief_description' => '',
        'project_link' => '',
        'thumbnail_path' => null,
        'skills' => [],
    ];
    public $editingProjectIndex = null;
    public $projectSkillSearch = [];

    protected $rules = [
        'projectForm.title' => 'required|string|max:255',
        'projectForm.brief_description' => 'required|string|max:500',
        'projectForm.project_link' => 'nullable|url|max:255',
        'projectForm.thumbnail_path' => 'nullable|image|max:2048',
        'projectForm.skills' => 'array',
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $this->projects = $this->portfolio->projects->map(function ($proj) {
            return [
                'id' => $proj->id,
                'title' => $proj->title,
                'brief_description' => $proj->brief_description,
                'project_link' => $proj->project_link,
                'thumbnail_path' => $proj->thumbnail_path,
                'skills' => $proj->skills->pluck('id')->toArray(),
            ];
        })->toArray();
    }

    public function addProject()
    {
        $this->resetForm();
        $this->editingProjectIndex = 'new';
    }

    public function editProject($index)
    {
        $this->editingProjectIndex = $index;
        $this->projectForm = $this->projects[$index];
    }

    public function cancelEditProject()
    {
        $this->resetForm();
        $this->editingProjectIndex = null;
    }

    private function resetForm()
    {
        $this->projectForm = [
            'title' => '',
            'brief_description' => '',
            'project_link' => '',
            'thumbnail_path' => null,
            'skills' => [],
        ];
    }

    public function deleteProject($index)
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
        }
    }


    public function saveProject()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $projectData = [
                'title' => $this->projectForm['title'],
                'brief_description' => $this->projectForm['brief_description'],
                'project_link' => $this->projectForm['project_link'],
            ];

           
            if ($this->projectForm['thumbnail_path'] && !is_string($this->projectForm['thumbnail_path'])) {
                $path = $this->projectForm['thumbnail_path']->store('portfolios/' . $this->portfolio->id . '/projects', 'public');
                $projectData['thumbnail_path'] = $path;
            }

            if ($this->editingProjectIndex === 'new') {
                $project = $this->portfolio->projects()->create($projectData);
                $project->skills()->sync($this->projectForm['skills']);
                $this->projects[] = array_merge($project->toArray(), ['skills' => $this->projectForm['skills']]);
            } else {
                $projectId = $this->projects[$this->editingProjectIndex]['id'];
                $project = $this->portfolio->projects()->find($projectId);
                $project->update($projectData);
                $project->skills()->sync($this->projectForm['skills']);
                $this->projects[$this->editingProjectIndex] = array_merge($project->toArray(), ['skills' => $this->projectForm['skills']]);
            }

            DB::commit();
            $this->dispatch('sectionSaved');
            $this->cancelEditProject();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.projects-section', [
            'availableSkills' => Skill::all(),
        ]);
    }
}
