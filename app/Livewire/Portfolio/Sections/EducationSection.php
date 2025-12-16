<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;

class EducationSection extends Component
{
    public Portfolio $portfolio;
    public $education = [];
    public $editingEducationIndex = null;
    public $educationForm = [
        'school' => '',
        'degree' => '',
        'education_period' => '',
    ];

    protected $rules = [
        'educationForm.school' => 'required|string|max:255',
        'educationForm.degree' => 'required|string|max:255',
        'educationForm.education_period' => 'required|string'
    ];

    protected $messages = [
        'educationForm.school.required' => 'School name is required.',
        'educationForm.school.string' => 'School name must be text.',
        'educationForm.school.max' => 'School name cannot exceed 255 characters.',

        'educationForm.degree.required' => 'Degree is required.',
        'educationForm.degree.string' => 'Degree must be text.',
        'educationForm.degree.max' => 'Degree cannot exceed 255 characters.',

        'educationForm.education_period.required' => 'Education period is required.',
        'educationForm.education_period.string' => 'Please enter a valid education period.',
    ];

    protected $validationAttributes = [
        'educationForm.school' => 'school name',
        'educationForm.degree' => 'degree',
        'educationForm.education_period' => 'education period',
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $this->education = $this->portfolio->educationRecords->map(function ($edu) {
            return [
                'id' => $edu->id,
                'school' => $edu->school,
                'degree' => $edu->degree,
                'education_period' => $this->formatEducationPeriod($edu->year_of_admission, $edu->year_of_graduation),
            ];
        })->toArray();
    }

    private function formatEducationPeriod($admission, $graduation)
    {
        if (!$admission) return '';

        return $graduation ? "{$admission} - {$graduation}" : $admission;
    }

    private function parseEducationPeriod($period)
    {
        $period = str_replace(' ', '', $period);

        if (strpos($period, '-') !== false) {
            [$start, $end] = explode('-', $period);

            return [
                'year_of_admission' => $start,
                'year_of_graduation' => $end
            ];
        } else {
            return [
                'year_of_admission' => $period,
                'year_of_graduation' => null
            ];
        }
    }

    public function addEducation()
    {
        $this->editingEducationIndex = 'new';
        $this->educationForm = [
            'school' => '',
            'degree' => '',
            'education_period' => '',
        ];
    }

    public function editEducation($index)
    {
        $this->editingEducationIndex = $index;
        $education = $this->education[$index];

        $this->educationForm = [
            'school' => $education['school'] ?? '',
            'degree' => $education['degree'] ?? '',
            'education_period' => $education['education_period'] ?? '',
        ];
    }

    public function saveEducation()
    {
       
        $this->validate();

        try {
            DB::beginTransaction();

            $dates = $this->parseEducationPeriod($this->educationForm['education_period']);

            if ($this->editingEducationIndex === 'new') {
               
                $newEducation = $this->portfolio->educationRecords()->create([
                    'school' => $this->educationForm['school'],
                    'degree' => $this->educationForm['degree'],
                    'year_of_admission' => $dates['year_of_admission'],
                    'year_of_graduation' => $dates['year_of_graduation'],
                ]);

               

                $this->education[] = array_merge(
                    $this->educationForm,
                    ['id' => $newEducation->id]
                );
            } else {
                $educationId = $this->education[$this->editingEducationIndex]['id'];
                
                $this->portfolio->educationRecords()
                    ->where('id', $educationId)
                    ->update([
                        'school' => $this->educationForm['school'],
                        'degree' => $this->educationForm['degree'],
                        'year_of_admission' => $dates['year_of_admission'],
                        'year_of_graduation' => $dates['year_of_graduation'],
                    ]);

                $this->education[$this->editingEducationIndex] = array_merge(
                    $this->educationForm,
                    ['id' => $educationId]
                );
            }
            DB::commit();
            $this->cancelEditEducation();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            session()->flash('error', 'Failed to save education record.');
        }
    }

    public function deleteEducation($index)
    {
        try {
            DB::beginTransaction();

            $educationId = $this->education[$index]['id'];
            $this->portfolio->educationRecords()->where('id', $educationId)->delete();

            unset($this->education[$index]);
            $this->education = array_values($this->education);

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete education record.');
        }
    }

    public function cancelEditEducation()
    {
        $this->editingEducationIndex = null;
        $this->educationForm = [
            'school' => '',
            'degree' => '',
            'education_period' => ''
        ];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.portfolio.sections.education-section');
    }
}