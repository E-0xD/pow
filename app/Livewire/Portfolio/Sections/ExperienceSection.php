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
        'start_date' => '',
        'end_date' => '',
        'description' => ''
    ];

    protected $rules = [    
        'experienceForm.company' => 'required|string|max:255',
        'experienceForm.position' => 'required|string|max:255',
        'experienceForm.start_date' => 'required',
        'experienceForm.end_date' => 'nullable',
        'experienceForm.description' => 'nullable|string|max:1000'
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
                'description' => $exp->description
            ];
        })->values()->toArray();
    }

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
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->editingExperienceIndex === 'new') {
                $newExperience = $this->portfolio->experiences()->create([
                    'company' => $this->experienceForm['company'],
                    'position' => $this->experienceForm['position'],
                    'start_date' => $this->experienceForm['start_date'],
                    'end_date' => $this->experienceForm['end_date'],
                    'description' => $this->experienceForm['description']
                ]);

                $this->experiences[] = array_merge(
                    $this->experienceForm,
                    ['id' => $newExperience->id]
                );
            } else {
                $experienceId = $this->experiences[$this->editingExperienceIndex]['id'];
                
                $this->portfolio->experiences()
                    ->where('id', $experienceId)
                    ->update([
                        'company' => $this->experienceForm['company'],
                        'position' => $this->experienceForm['position'],
                        'start_date' => $this->experienceForm['start_date'],
                        'end_date' => $this->experienceForm['end_date'],
                        'description' => $this->experienceForm['description']
                    ]);

                $this->experiences[$this->editingExperienceIndex] = array_merge(
                    $this->experienceForm,
                    ['id' => $experienceId]
                );
            }

            DB::commit();
            $this->cancelEditExperience();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save experience.');
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
            'start_date' => '',
            'end_date' => '',
            'description' => ''
        ];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.portfolio.sections.experience-section');
    }
}