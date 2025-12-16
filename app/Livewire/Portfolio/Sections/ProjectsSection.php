<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public $projectSkillSearch = '';
    public $projectSkillSearchResults = [];

    protected $rules = [
        'projectForm.title' => 'required|string|max:255',
        'projectForm.brief_description' => 'required|string|max:500',
        'projectForm.project_link' => 'nullable|url|max:255',
        'projectForm.thumbnail_path' => 'nullable',
        'projectForm.skills' => 'array',
    ];

    protected $messages = [
        'projectForm.title.required' => 'Project title is required.',
        'projectForm.title.string' => 'Project title must be text.',
        'projectForm.title.max' => 'Project title cannot exceed 255 characters.',

        'projectForm.brief_description.required' => 'Brief description is required.',
        'projectForm.brief_description.string' => 'Brief description must be text.',
        'projectForm.brief_description.max' => 'Brief description cannot exceed 500 characters.',

        'projectForm.project_link.url' => 'Project link must be a valid URL.',
        'projectForm.project_link.max' => 'Project link cannot exceed 255 characters.',

        'projectForm.skills.array' => 'Skills must be a valid list.',
    ];

    protected $validationAttributes = [
        'projectForm.title' => 'project title',
        'projectForm.brief_description' => 'brief description',
        'projectForm.project_link' => 'project link',
        'projectForm.thumbnail_path' => 'thumbnail',
        'projectForm.skills' => 'skills',
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

        // Reset skill search UI when editing an existing project
        $this->projectSkillSearch = '';
        $this->projectSkillSearchResults = [];

        // Clear any previous validation errors
        if (method_exists($this, 'resetErrorBag')) {
            $this->resetErrorBag();
        }
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
        $this->projectSkillSearch = '';
        $this->projectSkillSearchResults = [];
    }

    public function updatedProjectSkillSearch()
    {
        if (strlen($this->projectSkillSearch) > 1) {
            $this->projectSkillSearchResults = Skill::query()
                ->where('title', 'like', '%' . $this->projectSkillSearch . '%')
                ->limit(8)
                ->get(['id', 'title', 'logo'])
                ->toArray();
        } else {
            $this->projectSkillSearchResults = [];
        }
    }

    public function addProjectSkill($skillId)
    {
        $skill = Skill::find($skillId);
        if (!$skill) return;

        // Avoid duplicates
        if (in_array($skill->id, $this->projectForm['skills'])) return;

        $this->projectForm['skills'][] = $skill->id;
        $this->projectSkillSearch = '';
        $this->projectSkillSearchResults = [];
    }

    public function removeProjectSkill($skillId)
    {
        $this->projectForm['skills'] = array_filter(
            $this->projectForm['skills'],
            fn($id) => $id != $skillId
        );
        $this->projectForm['skills'] = array_values($this->projectForm['skills']);
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

        // If a new file was uploaded (Livewire provides an UploadedFile), validate it's an image
        if (!empty($this->projectForm['thumbnail_path']) && !is_string($this->projectForm['thumbnail_path'])) {
            Validator::make(
                ['projectForm.thumbnail_path' => $this->projectForm['thumbnail_path']],
                ['projectForm.thumbnail_path' => 'image|max:10240']
            )->validate();
        }

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
