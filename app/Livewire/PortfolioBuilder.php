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
    public $contacts = [];

    public function mount($portfolio)
    {
        // Accept either a bound Portfolio model or an id and ensure the user owns it
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
        // Load About Section
        if ($about = $this->portfolio->about) {
            $this->about = [
                'name' => $about->name,
                'logo' => null, // We don't load file uploads
                'brief' => $about->brief,
                'description' => $about->description
            ];
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'about');
        }

        // Load Experiences
        if ($this->portfolio->experiences) {
            $this->experiences = $this->portfolio->experiences->map(function($exp) {
                return [
                    'company' => $exp->company,
                    'position' => $exp->position,
                    'start_date' => $exp->start_date,
                    'end_date' => $exp->end_date
                ];
            })->toArray();
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'experience');
        }

        // Load Education
        if ($this->portfolio->educationRecords) {
            $this->education = $this->portfolio->educationRecords->map(function($edu) {
                return [
                    'school' => $edu->school,
                    'degree' => $edu->degree,
                    'year_of_admission' => $edu->year_of_admission,
                    'year_of_graduation' => $edu->year_of_graduation
                ];
            })->toArray();
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'education');
        }

        // Load Skills
        if ($this->portfolio->skills) {
            $this->selectedSkills = $this->portfolio->skills->pluck('id')->toArray();
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'skills');
        }

        // Load Projects
        if ($this->portfolio->projects) {
            $this->projects = $this->portfolio->projects->map(function($proj) {
                return [
                    'title' => $proj->title,
                    'brief_description' => $proj->brief_description,
                    'project_link' => $proj->project_link,
                    'thumbnail' => null, // We don't load file uploads
                    'skills' => $proj->skills->pluck('id')->toArray()
                ];
            })->toArray();
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'projects');
        }

        // Load Contact Methods
        if ($this->portfolio->contactMethods) {
            $this->contacts = $this->portfolio->contactMethods->map(function($contact) {
                return [
                    'method_id' => $contact->id,
                    'value' => $contact->pivot->value
                ];
            })->toArray();
            $this->selectedSections[] = collect($this->availableSections)->firstWhere('id', 'contact');
        }
    }

    private function initializeAvailableSections()
    {
        $this->availableSections = [
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
    }

    public function addSection($sectionId)
    {
     
        $section = collect($this->availableSections)->firstWhere('id', $sectionId);
        if ($section && !collect($this->selectedSections)->contains('id', $sectionId)) {
            
            $this->selectedSections[] = $section;
            $this->initializeFormData($sectionId);
            // remove from available sections so it cannot be added twice
            $this->availableSections = collect($this->availableSections)
                ->reject(fn($s) => $s['id'] === $sectionId)
                ->values()
                ->toArray();
        }  
    }

    public function removeSection($sectionId)
    {
        // find the section definition in the selected sections
        $removed = collect($this->selectedSections)->firstWhere('id', $sectionId);

        // remove from selected
        $this->selectedSections = collect($this->selectedSections)
            ->reject(fn($section) => $section['id'] === $sectionId)
            ->values()
            ->toArray();

        // add back to available sections if it existed in selected
        if ($removed) {
            // avoid duplicates
            if (!collect($this->availableSections)->contains('id', $sectionId)) {
                $this->availableSections[] = $removed;
                // optional: reindex available sections
                $this->availableSections = array_values($this->availableSections);
            }
        }
    }

    /**
     * Move a section up in the selectedSections array
     */
    public function moveUp($sectionId)
    {
        $ids = collect($this->selectedSections)->pluck('id')->toArray();
        $index = array_search($sectionId, $ids, true);
        if ($index === false || $index === 0) {
            return; // not found or already first
        }

        // swap with previous
        [$ids[$index - 1], $ids[$index]] = [$ids[$index], $ids[$index - 1]];

        // reorder selectedSections according to new ids
        $this->selectedSections = array_values(collect($ids)->map(fn($id) => collect($this->availableSections)->firstWhere('id', $id) ?? collect($this->selectedSections)->firstWhere('id', $id))->filter()->toArray());

        $this->persistOrder($ids);
    }

    /**
     * Move a section down in the selectedSections array
     */
    public function moveDown($sectionId)
    {
        $ids = collect($this->selectedSections)->pluck('id')->toArray();
        $index = array_search($sectionId, $ids, true);
        if ($index === false || $index === count($ids) - 1) {
            return; // not found or already last
        }

        // swap with next
        [$ids[$index], $ids[$index + 1]] = [$ids[$index + 1], $ids[$index]];

        // reorder selectedSections according to new ids
        $this->selectedSections = array_values(collect($ids)->map(fn($id) => collect($this->availableSections)->firstWhere('id', $id) ?? collect($this->selectedSections)->firstWhere('id', $id))->filter()->toArray());

        $this->persistOrder($ids);
    }

    /**
     * Persist the given ordered section ids for this portfolio
     */
    private function persistOrder(array $orderedIds)
    {
        try {
            foreach ($orderedIds as $index => $id) {
                DB::table('portfolio_section_orders')->updateOrInsert(
                    ['portfolio_id' => $this->portfolio->id, 'section_id' => $id],
                    ['position' => $index]
                );
            }

            // Remove any records for this portfolio that are no longer selected
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
                $this->experiences[] = [
                    'company' => '',
                    'position' => '',
                    'start_date' => '',
                    'end_date' => ''
                ];
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

    public function addExperience()
    {
        $this->experiences[] = [
            'company' => '',
            'position' => '',
            'start_date' => '',
            'end_date' => ''
        ];
    }

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

    public function removeExperience($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
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
        'about.logo' => 'nullable|image|max:1024', // 1MB Max
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

        // Only validate active sections
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

            // Save Experiences
            if (in_array('experience', collect($this->selectedSections)->pluck('id')->toArray())) {
                $this->portfolio->experiences()->delete();
                foreach ($this->experiences as $exp) {
                    $this->portfolio->experiences()->create($exp);
                }
            }

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
                    collect($this->contacts)->mapWithKeys(function($contact) {
                        return [$contact['method_id'] => ['value' => $contact['value']]];
                    })->toArray()
                );
            }

            // Persist the user's chosen section ordering
            $orderedIds = collect($this->selectedSections)->pluck('id')->toArray();
            foreach ($orderedIds as $index => $id) {
                DB::table('portfolio_section_orders')->updateOrInsert(
                    ['portfolio_id' => $this->portfolio->id, 'section_id' => $id],
                    ['position' => $index]
                );
            }
            // Remove any leftover orders for sections no longer selected
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
