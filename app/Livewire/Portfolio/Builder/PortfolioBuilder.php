<?php

namespace App\Livewire\Portfolio\Builder;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Portfolio;
use App\Models\Skill;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class PortfolioBuilder extends Component
{
    public $currentStep = 1;
    public Portfolio $portfolio;
    public $selectedSections = [];
    public $availableSections;


    public function mount($portfolio)
    {
        if ($portfolio instanceof Portfolio) {
            $this->portfolio = $portfolio;
        } else {
            $this->portfolio = Auth::user()->portfolios()->findOrFail($portfolio);
        }

        $this->initializeAvailableSections();
    }

    public function handleSectionSaved()
    {
        session()->flash('message', 'Section updated successfully.');
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



    // ========== SECTION MANAGEMENT METHODS ==========

    public function addSection($sectionId)
    {
        $section = collect($this->availableSections)->firstWhere('id', $sectionId);
        if ($section && !collect($this->selectedSections)->contains('id', $sectionId)) {
            try {
                DB::beginTransaction();

                $this->selectedSections[] = $section;


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
                dd($e);
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

    public function render()
    {
        return view('livewire.portfolio.builder.portfolio-builder');
    }
}
