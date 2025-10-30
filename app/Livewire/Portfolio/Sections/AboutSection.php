<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;

class AboutSection extends Component
{
    use WithFileUploads;

    public Portfolio $portfolio;
    public $about = [
        'name' => '',
        'logo' => null,
        'brief' => '',
        'description' => ''
    ];

    protected $rules = [
        'about.name' => 'required|string|max:255',
        'about.logo' => 'nullable|image|max:1024',
        'about.brief' => 'required|string|max:255',
        'about.description' => 'required|string|max:1000',
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        if ($about = $this->portfolio->about) {
            $this->about = [
                'name' => $about->name,
                'logo' => null,
                'brief' => $about->brief,
                'description' => $about->description
            ];
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            
            $this->portfolio->about()->updateOrCreate(
                ['portfolio_id' => $this->portfolio->id],
                [
                    'name' => $this->about['name'],
                    'brief' => $this->about['brief'],
                    'description' => $this->about['description']
                ]
            );

            if ($this->about['logo']) {
                $path = $this->about['logo']->store('public/portfolios/' . $this->portfolio->id);
                $this->portfolio->about()->update(['logo' => $path]);
            }

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save about section.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.about-section');
    }
}