<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\ContactMethod;

class PortfolioBuilder extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public Portfolio $portfolio;
    public $selectedSections = [];
    public $availableSections;
    
    // Add these new properties
    public $editingExperienceIndex = null;
    public $experienceForm = [
        'company' => '',
        'position' => '',
        'start_date' => '',
        'end_date' => '',
        'description' => ''
    ];
    
    protected $listeners = [
        'addSection',
        'removeSection'
    ];

    // Form data
    public $about = [
        'name' => '',
        'logo' => null,
        'brief' => '',
        'description' => ''
    ];

    public $experiences = [];
    public $selectedSkills = [];
    public $education = [];
    public $projects = [];
    public $projectSkillSearch = [];
    public $contacts = [];

    public function mount($portfolio)
    {
        if ($portfolio instanceof Portfolio) {
            $this->portfolio = $portfolio;
        } else {
            $this->portfolio = Auth::user()->portfolios()->findOrFail($portfolio);
        }

        $this->initializeAvailableSections();
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $selectedSectionIds = collect($this->selectedSections)->pluck('id')->toArray();

        // Load About Section
        if (in_array('about', $selectedSectionIds) && $about = $this->portfolio->about) {
            $this->about = [
                'name' => $about->name,
                'logo' => null,
                'brief' => $about->brief,
                'description' => $about->description
            ];
        }

        // Load Experiences
        if (in_array('experience', $selectedSectionIds)) {
            $this->experiences = $this->portfolio->experiences->map(function ($exp) {
                return [
                    'id' => $exp->id,
                    'company' => $exp->company,
                    'position' => $exp->position,
                    'start_date' => $exp->start_date,
                    'end_date' => $exp->end_date,
                    'description' => $exp->description ?? ''
                ];
            })->values()->toArray();
        }

        // Load Education
        if (in_array('education', $selectedSectionIds) && $this->portfolio->educationRecords) {
            $this->education = $this->portfolio->educationRecords->map(function ($edu) {
                return [
                    'school' => $edu->school,
                    'degree' => $edu->degree,
                    'year_of_admission' => $edu->year_of_admission,
                    'year_of_graduation' => $edu->year_of_graduation
                ];
            })->toArray();
        }

        // Load Skills
        if (in_array('skills', $selectedSectionIds) && $this->portfolio->skills) {
            $this->selectedSkills = $this->portfolio->skills->pluck('id')->toArray();
        }

        // Load Projects
        if (in_array('projects', $selectedSectionIds) && $this->portfolio->projects) {
            $this->projects = $this->portfolio->projects->map(function ($proj) {
                return [
                    'title' => $proj->title,
                    'brief_description' => $proj->brief_description,
                    'project_link' => $proj->project_link,
                    'thumbnail' => null,
                    'skills' => $proj->skills->pluck('id')->toArray()
                ];
            })->toArray();
        }

        // Load Contact Methods
        if (in_array('contact', $selectedSectionIds) && $this->portfolio->contactMethods) {
            $this->contacts = $this->portfolio->contactMethods->map(function ($contact) {
                return [
                    'method_id' => $contact->id,
                    'value' => $contact->pivot->value
                ];
            })->toArray();
        }
    }

    private function initializeAvailableSections()
    {
        $allSections = [
            [
                'id' => 'about',
                'title' => 'About',
                'description' => 'A brief introduction about yourself.',
                'icon' => 'person'
            ],
            [
                'id' => 'experience',
                'title' => 'Work Experience',
                'description' => 'Detail your professional history.',
                'icon' => 'work'
            ],
            [
                'id' => 'skills',
                'title' => 'Skills',
                'description' => 'List your technical and soft skills.',
                'icon' => 'lightbulb'
            ],
            [
                'id' => 'education',
                'title' => 'Education',
                'description' => 'Your academic background.',
                'icon' => 'school'
            ],
            [
                'id' => 'projects',
                'title' => 'Projects',
                'description' => 'Showcase your best work.',
                'icon' => 'grid_view'
            ],
            [
                'id' => 'contact',
                'title' => 'Contact',
                'description' => 'How people can get in touch.',
                'icon' => 'mail'
            ]
        ];

        if (!$this->portfolio || !$this->portfolio->id) {
            $this->selectedSections = [];
            $this->availableSections = $allSections;
            return;
        }

        $selectedSectionIds = DB::table('portfolio_section_orders')
            ->where('portfolio_id', $this->portfolio->id)
            ->orderBy('position')
            ->pluck('section_id')
            ->toArray();

        if (empty($selectedSectionIds)) {
            $this->selectedSections = [];
            $this->availableSections = $allSections;
            return;
        }

        $this->selectedSections = collect($allSections)
            ->filter(function ($section) use ($selectedSectionIds) {
                return in_array($section['id'], $selectedSectionIds);
            })
            ->sortBy(function ($section) use ($selectedSectionIds) {
                return array_search($section['id'], $selectedSectionIds);
            })
            ->values()
            ->toArray();

        $this->availableSections = collect($allSections)
            ->reject(function ($section) use ($selectedSectionIds) {
                return in_array($section['id'], $selectedSectionIds);
            })
            ->values()
            ->toArray();
    }

    // ========== EXPERIENCE METHODS ==========
    
    public function addNewExperience()
    {
        $this->editingExperienceIndex = 'new';
        $this->experienceForm = [
            'company' => '',
            'position' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => ''
        ];
    }

    public function editExperience($index)
    {
        $this->editingExperienceIndex = $index;
        $experience = $this->experiences[$index];
        
        $this->experienceForm = [
            'company' => $experience['company'] ?? '',
            'position' => $experience['position'] ?? '',
            'start_date' => $experience['start_date'] ?? '',
            'end_date' => $experience['end_date'] ?? '',
            'description' => $experience['description'] ?? ''
        ];
    }

    public function saveExperience()
    {
        $this->validate([
            'experienceForm.company' => 'required|string|max:255',
            'experienceForm.position' => 'required|string|max:255',
            'experienceForm.start_date' => 'required|date',
            'experienceForm.end_date' => 'nullable|date|after_or_equal:experienceForm.start_date',
            'experienceForm.description' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            if ($this->editingExperienceIndex === 'new') {
                // Insert new experience
                $newExperience = $this->portfolio->experiences()->create([
                    'company' => $this->experienceForm['company'],
                    'position' => $this->experienceForm['position'],
                    'start_date' => $this->experienceForm['start_date'],
                    'end_date' => $this->experienceForm['end_date'] ?: null,
                    'description' => $this->experienceForm['description']
                ]);

                // Add to local array
                $this->experiences[] = [
                    'id' => $newExperience->id,
                    'company' => $newExperience->company,
                    'position' => $newExperience->position,
                    'start_date' => $newExperience->start_date,
                    'end_date' => $newExperience->end_date,
                    'description' => $newExperience->description
                ];

                session()->flash('message', 'Experience added successfully!');
            } else {
                // Update existing experience
                $experienceId = $this->experiences[$this->editingExperienceIndex]['id'];
                
                $this->portfolio->experiences()
                    ->where('id', $experienceId)
                    ->update([
                        'company' => $this->experienceForm['company'],
                        'position' => $this->experienceForm['position'],
                        'start_date' => $this->experienceForm['start_date'],
                        'end_date' => $this->experienceForm['end_date'] ?: null,
                        'description' => $this->experienceForm['description']
                    ]);

                // Update local array
                $this->experiences[$this->editingExperienceIndex] = [
                    'id' => $experienceId,
                    'company' => $this->experienceForm['company'],
                    'position' => $this->experienceForm['position'],
                    'start_date' => $this->experienceForm['start_date'],
                    'end_date' => $this->experienceForm['end_date'],
                    'description' => $this->experienceForm['description']
                ];

                session()->flash('message', 'Experience updated successfully!');
            }

            DB::commit();
            $this->cancelEditExperience();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('error', 'An error occurred while saving experience.');
        }
    }

    public function deleteExperience($index)
    {
        try {
            DB::beginTransaction();

            $experienceId = $this->experiences[$index]['id'];
            
            $this->portfolio->experiences()
                ->where('id', $experienceId)
                ->delete();

            // Remove from local array
            unset($this->experiences[$index]);
            $this->experiences = array_values($this->experiences);

            DB::commit();
            session()->flash('message', 'Experience deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while deleting experience.');
        }
    }

    public function cancelEditExperience()
    {
        $this->editingExperienceIndex = null;
        $this->experienceForm = [
            'company' => '',
            'position' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => ''
        ];
        $this->resetErrorBag();
    }

    // Keep your existing addExperience and removeExperience for backward compatibility
    public function addExperience()
    {
        $this->addNewExperience();
    }
    
    public function removeExperience($index)
    {
        $this->deleteExperience($index);
    }

    // ========== SECTION MANAGEMENT METHODS ==========

    public function addSection($sectionId)
    {
        $section = collect($this->availableSections)->firstWhere('id', $sectionId);
        if ($section && !collect($this->selectedSections)->contains('id', $sectionId)) {
            try {
                DB::beginTransaction();

                $this->selectedSections[] = $section;
                $this->initializeFormData($sectionId);

                $this->availableSections = collect($this->availableSections)
                    ->reject(fn($s) => $s['id'] === $sectionId)
                    ->values()
                    ->toArray();

                $newPosition = DB::table('portfolio_section_orders')
                    ->where('portfolio_id', $this->portfolio->id)
                    ->count();

                DB::table('portfolio_section_orders')->insert([
                    'portfolio_id' => $this->portfolio->id,
                    'section_id' => $sectionId,
                    'position' => $newPosition,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->initializeAvailableSections();
            }
        }
    }

    public function removeSection($sectionId)
    {
        try {
            DB::beginTransaction();

            $removed = collect($this->selectedSections)->firstWhere('id', $sectionId);

            $this->selectedSections = collect($this->selectedSections)
                ->reject(fn($section) => $section['id'] === $sectionId)
                ->values()
                ->toArray();

            if ($removed) {
                if (!collect($this->availableSections)->contains('id', $sectionId)) {
                    $this->availableSections[] = $removed;
                    $this->availableSections = array_values($this->availableSections);
                }
            }

            DB::table('portfolio_section_orders')
                ->where('portfolio_id', $this->portfolio->id)
                ->where('section_id', $sectionId)
                ->delete();

            $remainingSections = collect($this->selectedSections)->pluck('id')->toArray();
            foreach ($remainingSections as $index => $id) {
                DB::table('portfolio_section_orders')
                    ->where('portfolio_id', $this->portfolio->id)
                    ->where('section_id', $id)
                    ->update(['position' => $index]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->initializeAvailableSections();
        }
    }

    public function moveUp($sectionId)
    {
        $ids = collect($this->selectedSections)->pluck('id')->toArray();
        $index = array_search($sectionId, $ids, true);
        if ($index === false || $index === 0) {
            return;
        }

        [$ids[$index - 1], $ids[$index]] = [$ids[$index], $ids[$index - 1]];

        $this->selectedSections = array_values(collect($ids)->map(fn($id) => collect($this->availableSections)->firstWhere('id', $id) ?? collect($this->selectedSections)->firstWhere('id', $id))->filter()->toArray());

        $this->persistOrder($ids);
    }

    public function moveDown($sectionId)
    {
        $ids = collect($this->selectedSections)->pluck('id')->toArray();
        $index = array_search($sectionId, $ids, true);
        if ($index === false || $index === count($ids) - 1) {
            return;
        }

        [$ids[$index], $ids[$index + 1]] = [$ids[$index + 1], $ids[$index]];

        $this->selectedSections = array_values(collect($ids)->map(fn($id) => collect($this->availableSections)->firstWhere('id', $id) ?? collect($this->selectedSections)->firstWhere('id', $id))->filter()->toArray());

        $this->persistOrder($ids);
    }

    private function persistOrder(array $orderedIds)
    {
        try {
            foreach ($orderedIds as $index => $id) {
                DB::table('portfolio_section_orders')->updateOrInsert(
                    ['portfolio_id' => $this->portfolio->id, 'section_id' => $id],
                    ['position' => $index]
                );
            }

            DB::table('portfolio_section_orders')
                ->where('portfolio_id', $this->portfolio->id)
                ->whereNotIn('section_id', $orderedIds)
                ->delete();
        } catch (\Exception $e) {
            // ignore persistence errors for ordering
        }
    }

    private function initializeFormData($sectionId)
    {
        switch ($sectionId) {
            case 'experience':
                // Don't add empty experience automatically
                break;
            case 'education':
                $this->education[] = [
                    'school' => '',
                    'degree' => '',
                    'year_of_admission' => '',
                    'year_of_graduation' => ''
                ];
                break;
            case 'projects':
                $this->projects[] = [
                    'title' => '',
                    'brief_description' => '',
                    'project_link' => '',
                    'thumbnail' => null,
                    'skills' => []
                ];
                break;
            case 'contact':
                $this->contacts[] = [
                    'method_id' => '',
                    'value' => ''
                ];
                break;
        }
    }

    // ========== OTHER SECTION METHODS ==========

    public function addEducation()
    {
        $this->education[] = [
            'school' => '',
            'degree' => '',
            'year_of_admission' => '',
            'year_of_graduation' => ''
        ];
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

    public function addContact()
    {
        $this->contacts[] = [
            'method_id' => '',
            'value' => ''
        ];
    }

    public function removeEducation($index)
    {
        unset($this->education[$index]);
        $this->education = array_values($this->education);
    }

    public function removeProject($index)
    {
        unset($this->projects[$index]);
        $this->projects = array_values($this->projects);
    }

    public function removeContact($index)
    {
        unset($this->contacts[$index]);
        $this->contacts = array_values($this->contacts);
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

    // ========== NAVIGATION & SAVE ==========

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            if (empty($this->selectedSections)) {
                $this->addError('sections', 'Please select at least one section.');
                return;
            }
            $this->currentStep = 2;
        } else {
            $this->save();
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        } else {
            return redirect()->route('user.portfolio.create');
        }
    }

    protected $rules = [
        'about.name' => 'required|string|max:255',
        'about.logo' => 'nullable|image|max:1024',
        'about.brief' => 'required|string|max:255',
        'about.description' => 'required|string|max:1000',

        'experiences.*.company' => 'required|string|max:255',
        'experiences.*.position' => 'required|string|max:255',
        'experiences.*.start_date' => 'required|date',
        'experiences.*.end_date' => 'nullable|date|after:experiences.*.start_date',

        'education.*.school' => 'required|string|max:255',
        'education.*.degree' => 'required|string|max:255',
        'education.*.year_of_admission' => 'required|integer|min:1900|max:2025',
        'education.*.year_of_graduation' => 'required|integer|min:1900|max:2035|gte:education.*.year_of_admission',

        'selectedSkills' => 'required|array|min:1',
        'selectedSkills.*' => 'exists:skills,id',

        'projects.*.title' => 'required|string|max:255',
        'projects.*.brief_description' => 'required|string|max:500',
        'projects.*.project_link' => 'nullable|url|max:255',
        'projects.*.thumbnail' => 'nullable|image|max:1024',
        'projects.*.skills' => 'required|array|min:1',
        'projects.*.skills.*' => 'exists:skills,id',

        'contacts.*.method_id' => 'required|exists:contact_methods,id',
        'contacts.*.value' => 'required|string|max:255'
    ];

    public function save()
    {
        $validationRules = [];

        foreach ($this->selectedSections as $section) {
            switch ($section['id']) {
                case 'about':
                    $validationRules['about.name'] = $this->rules['about.name'];
                    $validationRules['about.logo'] = $this->rules['about.logo'];
                    $validationRules['about.brief'] = $this->rules['about.brief'];
                    $validationRules['about.description'] = $this->rules['about.description'];
                    break;
                case 'experience':
                    if (!empty($this->experiences)) {
                        $validationRules['experiences.*.company'] = $this->rules['experiences.*.company'];
                        $validationRules['experiences.*.position'] = $this->rules['experiences.*.position'];
                        $validationRules['experiences.*.start_date'] = $this->rules['experiences.*.start_date'];
                        $validationRules['experiences.*.end_date'] = $this->rules['experiences.*.end_date'];
                    }
                    break;
                case 'education':
                    if (!empty($this->education)) {
                        $validationRules['education.*.school'] = $this->rules['education.*.school'];
                        $validationRules['education.*.degree'] = $this->rules['education.*.degree'];
                        $validationRules['education.*.year_of_admission'] = $this->rules['education.*.year_of_admission'];
                        $validationRules['education.*.year_of_graduation'] = $this->rules['education.*.year_of_graduation'];
                    }
                    break;
                case 'skills':
                    $validationRules['selectedSkills'] = $this->rules['selectedSkills'];
                    $validationRules['selectedSkills.*'] = $this->rules['selectedSkills.*'];
                    break;
                case 'projects':
                    if (!empty($this->projects)) {
                        $validationRules['projects.*.title'] = $this->rules['projects.*.title'];
                        $validationRules['projects.*.brief_description'] = $this->rules['projects.*.brief_description'];
                        $validationRules['projects.*.project_link'] = $this->rules['projects.*.project_link'];
                        $validationRules['projects.*.thumbnail'] = $this->rules['projects.*.thumbnail'];
                        $validationRules['projects.*.skills'] = $this->rules['projects.*.skills'];
                        $validationRules['projects.*.skills.*'] = $this->rules['projects.*.skills.*'];
                    }
                    break;
                case 'contact':
                    if (!empty($this->contacts)) {
                        $validationRules['contacts.*.method_id'] = $this->rules['contacts.*.method_id'];
                        $validationRules['contacts.*.value'] = $this->rules['contacts.*.value'];
                    }
                    break;
            }
        }

        $this->validate($validationRules);

        try {
            DB::beginTransaction();

            // Save About Section
            if (in_array('about', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->about()->updateOrCreate(
                    [],
                    [
                        'name' => $this->about['name'],
                        'brief' => $this->about['brief'],
                        'description' => $this->about['description']
                    ]
                );

                if ($this->about['logo']) {
                    $this->portfolio->about->addMedia($this->about['logo'])
                        ->toMediaCollection('logo');
                }
            }

            // Experiences are now saved individually via saveExperience()
            // So we skip the bulk delete/create here

            // Save Education
            if (in_array('education', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->educationRecords()->delete();
                foreach ($this->education as $edu) {
                    $this->portfolio->educationRecords()->create($edu);
                }
            }

            // Save Skills
            if (in_array('skills', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->skills()->sync($this->selectedSkills);
            }

            // Save Projects
            if (in_array('projects', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->projects()->delete();
                foreach ($this->projects as $project) {
                    $thumbnail = $project['thumbnail'] ?? null;
                    unset($project['thumbnail']);

                    $skills = $project['skills'] ?? [];
                    unset($project['skills']);

                    $newProject = $this->portfolio->projects()->create($project);

                    if ($thumbnail) {
                        $newProject->addMedia($thumbnail)
                            ->toMediaCollection('thumbnail');
                    }

                    $newProject->skills()->sync($skills);
                }
            }

            // Save Contact Methods
            if (in_array('contact', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->contactMethods()->sync(
                    collect($this->contacts)->mapWithKeys(function ($contact) {
                        return [$contact['method_id'] => ['value' => $contact['value']]];
                    })->toArray()
                );
            }

            $orderedIds = collect($this->selectedSections)->pluck('id')->toArray();
            foreach ($orderedIds as $index => $id) {
                DB::table('portfolio_section_orders')->updateOrInsert(
                    ['portfolio_id' => $this->portfolio->id, 'section_id' => $id],
                    ['position' => $index]
                );
            }
            
            DB::table('portfolio_section_orders')
                ->where('portfolio_id', $this->portfolio->id)
                ->whereNotIn('section_id', $orderedIds)
                ->delete();

            DB::commit();
            session()->flash('message', 'Portfolio updated successfully.');

            return redirect()->route('user.portfolio.show', $this->portfolio);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while saving your portfolio.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio-builder', [
            'availableSkills' => collect($this->selectedSections)->contains('id', 'skills') ? Skill::all() : collect(),
            'contactMethods' => collect($this->selectedSections)->contains('id', 'contact') ? ContactMethod::all() : collect(),
            'skills' => collect($this->selectedSections)->contains('id', 'skills') ? Skill::all() : collect(),
        ]);
    }
}