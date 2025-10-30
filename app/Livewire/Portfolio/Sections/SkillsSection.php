<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class SkillsSection extends Component
{
    public Portfolio $portfolio;
    public $selectedSkills = []; // holds full skill data for display
    public $skillSearch = '';
    public $searchResults = [];



    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $this->selectedSkills = $this->portfolio->skills
            ->map(fn($skill) => [
                'id' => $skill->id,
                'title' => $skill->title,
                'logo' => $skill->logo,
            ])
            ->toArray();
    }

    public function updatedSkillSearch()
    {
        if (strlen($this->skillSearch) > 1) {
            $this->searchResults = Skill::query()
                ->where('title', 'like', '%' . $this->skillSearch . '%')
                ->limit(8)
                ->get(['id', 'title', 'logo'])
                ->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    public function removeSkill($index)
    {
        if (!isset($this->selectedSkills[$index])) return;

        $skillId = $this->selectedSkills[$index]['id'];

        try {
            DB::beginTransaction();

            // Remove from database
            $this->portfolio->skills()->detach($skillId);

            // Remove from local array
            unset($this->selectedSkills[$index]);
            $this->selectedSkills = array_values($this->selectedSkills);

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();

            $this->loadExistingData();
        }
    }

    public function selectSkill($skillId)
    {
        $skill = Skill::find($skillId);
        if (!$skill) return;

        // Avoid duplicates
        if (collect($this->selectedSkills)->pluck('id')->contains($skill->id)) return;

        try {
            DB::beginTransaction();

            // Add to database
            $this->portfolio->skills()->attach($skill->id);

            // Add to local array
            $this->selectedSkills[] = [
                'id' => $skill->id,
                'title' => $skill->title,
                'logo' => $skill->logo,
            ];

            DB::commit();

            $this->skillSearch = '';
            $this->searchResults = [];
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.skills-section');
    }
}
