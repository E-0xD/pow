<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class SkillsSection extends Component
{
    public Portfolio $portfolio;
    public $selectedSkills = [];

    protected $rules = [
        'selectedSkills' => 'required|array|min:1',
        'selectedSkills.*' => 'exists:skills,id'
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        if ($this->portfolio->skills) {
            $this->selectedSkills = $this->portfolio->skills->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            
            $this->portfolio->skills()->sync($this->selectedSkills);
            
            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save skills.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.skills-section', [
            'availableSkills' => Skill::all()
        ]);
    }
}