<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AboutSection extends Component
{
    use WithFileUploads;

    public Portfolio $portfolio;
    public $about = [
        'name' => '',
        'logo' => null,
        'brief' => '',
        'description' => '',
        'collapsed' => true,
    ];

    protected $rules = [
        'about.name' => 'required|string|max:255',
        'about.logo' => 'nullable|image|max:10240',
        'about.brief' => 'required|string|max:255',
        'about.description' => 'required|string|max:5000',
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
                'logo' => $about->logo,
                'brief' => $about->brief,
                'description' => $about->description,
                'collapsed' => true,
            ];
        }
    }

    public function toggleCollapse()
    {
        $this->about['collapsed'] = !$this->about['collapsed'];
    }

    public function deleteAbout()
    {
        try {
            DB::beginTransaction();

            if ($this->portfolio->about) {
                if ($this->portfolio->about->logo && Storage::exists($this->portfolio->about->logo)) {
                    Storage::delete($this->portfolio->about->logo);
                }

                $this->portfolio->about()->delete();
            }

            $this->about = [
                'name' => '',
                'logo' => null,
                'brief' => '',
                'description' => '',
                'collapsed' => false,
            ];

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete about section.');
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $aboutData = [
                'name' => $this->about['name'],
                'brief' => $this->about['brief'],
                'description' => $this->about['description'],
            ];

            $aboutModel = $this->portfolio->about()->updateOrCreate(
                ['portfolio_id' => $this->portfolio->id],
                $aboutData
            );

            if ($this->about['logo'] instanceof TemporaryUploadedFile) {
                $path = $this->about['logo']->store('portfolios/' . $this->portfolio->id, 'public');
                $aboutModel->update(['logo' => $path]);
                $this->about['logo'] = $path;
            }

            $this->about['collapsed'] = true;

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
