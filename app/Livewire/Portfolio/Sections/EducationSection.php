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
        'year_of_admission' => '',
        'year_of_graduation' => '',

    ];

    protected $rules = [
        'educationForm.school' => 'required|string|max:255',
        'educationForm.degree' => 'required|string|max:255',
        'educationForm.year_of_admission' => 'required|',
        'educationForm.year_of_graduation' => 'nullable'
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
                'year_of_admission' => $edu->year_of_admission,
                'year_of_graduation' => $edu->year_of_graduation,
            ];
        })->toArray();
    }

    public function addEducation()
    {
        $this->editingEducationIndex = 'new';
        $this->educationForm = [
            'school' => '',
            'degree' => '',
            'year_of_admission' => '',
            'year_of_graduation' => '',
        ];
    }

    public function editEducation($index)
    {
        $this->editingEducationIndex = $index;
        $education = $this->education[$index];

        $this->educationForm = [
            'school' => $education['school'] ?? '',
            'degree' => $education['degree'] ?? '',
            'year_of_admission' => $education['year_of_admission'] ?? '',
            'year_of_graduation' => $education['year_of_graduation'] ?? '',
        ];
    }

    public function saveEducation()
    {
       
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->editingEducationIndex === 'new') {
               
                $newEducation = $this->portfolio->educationRecords()->create([
                    'school' => $this->educationForm['school'],
                    'degree' => $this->educationForm['degree'],
                    'year_of_admission' => $this->educationForm['year_of_admission'],
                    'year_of_graduation' => $this->educationForm['year_of_graduation'],
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
                        'year_of_admission' => $this->educationForm['year_of_admission'],
                        'year_of_graduation' => $this->educationForm['year_of_graduation'],
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
            'year_of_admission' => '',
            'year_of_graduation' => '',
            'description' => ''
        ];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.portfolio.sections.education-section');
    }
}