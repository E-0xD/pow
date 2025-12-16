<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExperienceSection extends Component
{
    public Portfolio $portfolio;
    public $experiences = [];
    public $editingExperienceIndex = null;
    public $experienceForm = [
        'company' => '',
        'position' => '',
        'description' => '',
        'employment_period' => ''
    ];

    protected $rules = [
        'experienceForm.company' => 'required|string|max:255',
        'experienceForm.position' => 'required|string|max:255',
        'experienceForm.employment_period' => 'required|string',
        'experienceForm.description' => 'nullable|string|max:1000'
    ];

    protected $messages = [
        'experienceForm.company.required' => 'Company name is required.',
        'experienceForm.company.string' => 'Company name must be text.',
        'experienceForm.company.max' => 'Company name cannot exceed 255 characters.',

        'experienceForm.position.required' => 'Job position is required.',
        'experienceForm.position.string' => 'Job position must be text.',
        'experienceForm.position.max' => 'Job position cannot exceed 255 characters.',

        'experienceForm.employment_period.required' => 'Employment period is required.',
        'experienceForm.employment_period.string' => 'Please enter a valid employment period.',

        'experienceForm.description.string' => 'Description must be text.',
        'experienceForm.description.max' => 'Description cannot exceed 1000 characters.',
    ];

    protected $validationAttributes = [
        'experienceForm.company' => 'company name',
        'experienceForm.position' => 'job position',
        'experienceForm.employment_period' => 'employment period',
        'experienceForm.description' => 'description',
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $this->experiences = $this->portfolio->experiences->map(function ($exp) {
            return [
                'id' => $exp->id,
                'company' => $exp->company,
                'position' => $exp->position,
                'start_date' => $exp->start_date,
                'end_date' => $exp->end_date,
                'employment_period' => $this->formatEmploymentPeriod($exp->start_date, $exp->end_date),
                'description' => $exp->description
            ];
        })->values()->toArray();
    }

    private function formatEmploymentPeriod($startDate, $endDate)
    {
        if (!$startDate) return '';

        return $endDate ? "{$startDate} - {$endDate}" : $startDate;
    }

    private function parseEmploymentPeriod($employmentPeriod)
    {
        // Remove spaces and split by dash
        $period = str_replace(' ', '', $employmentPeriod);

        if (strpos($period, '-') !== false) {
            // Range format: MM/YYYY - MM/YYYY
            [$start, $end] = explode('-', $period);

            return [
                'start_date' => $start,
                'end_date' => $end
            ];
        } else {
            // Single date format: MM/YYYY
            return [
                'start_date' => $period,
                'end_date' => null
            ];
        }
    }


    public function addNewExperience()
    {
        $this->editingExperienceIndex = 'new';
        $this->experienceForm = [
            'company' => '',
            'position' => '',
            'employment_period' => '',
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
            'employment_period' => $experience['employment_period'] ?? '',
            'description' => $experience['description'] ?? ''
        ];
    }

    public function saveExperience()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Parse employment period into start_date and end_date
            $dates = $this->parseEmploymentPeriod($this->experienceForm['employment_period']);

            $data = [
                'company' => $this->experienceForm['company'],
                'position' => $this->experienceForm['position'],
                'start_date' => $dates['start_date'],
                'end_date' => $dates['end_date'],
                'description' => $this->experienceForm['description']
            ];

            if ($this->editingExperienceIndex === 'new') {
                $newExperience = $this->portfolio->experiences()->create($data);

                $this->experiences[] = [
                    'id' => $newExperience->id,
                    'company' => $data['company'],
                    'position' => $data['position'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'employment_period' => $this->experienceForm['employment_period'],
                    'description' => $data['description']
                ];
            } else {
                $experienceId = $this->experiences[$this->editingExperienceIndex]['id'];

                $this->portfolio->experiences()
                    ->where('id', $experienceId)
                    ->update($data);

                $this->experiences[$this->editingExperienceIndex] = [
                    'id' => $experienceId,
                    'company' => $data['company'],
                    'position' => $data['position'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'employment_period' => $this->experienceForm['employment_period'],
                    'description' => $data['description']
                ];
            }

            DB::commit();
            $this->cancelEditExperience();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save experience: ' . $e->getMessage());
        }
    }

    public function deleteExperience($index)
    {
        try {
            DB::beginTransaction();

            $experienceId = $this->experiences[$index]['id'];
            $this->portfolio->experiences()->where('id', $experienceId)->delete();

            unset($this->experiences[$index]);
            $this->experiences = array_values($this->experiences);

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete experience.');
        }
    }

    public function cancelEditExperience()
    {
        $this->editingExperienceIndex = null;
        $this->experienceForm = [
            'company' => '',
            'position' => '',
            'employment_period' => '',
            'description' => ''
        ];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.portfolio.sections.experience-section');
    }
}
