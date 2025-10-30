<?php

namespace App\Livewire\Portfolio\Sections;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\ContactMethod;
use Illuminate\Support\Facades\DB;

class ContactSection extends Component
{
    public Portfolio $portfolio;
    public $contacts = [];
    public $contactSearch = '';
    public $searchResults = [];
    public $editingIndex = null;

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        $this->contacts = $this->portfolio->contactMethods
            ->map(fn($contact) => [
                'id' => $contact->id,
                'method_id' => $contact->contactMethod?->id,
                'method' => $contact->contactMethod?->title,
                'logo' => $contact->contactMethod?->logo,
                'value' => $contact->value,
                'collapsed' => true,
            ])
            ->toArray();
    }

    public function updatedContactSearch()
    {
        if (strlen($this->contactSearch) > 1) {
            $this->searchResults = ContactMethod::query()
                ->where('title', 'like', '%' . $this->contactSearch . '%')
                ->limit(8)
                ->get(['id', 'title', 'logo'])
                ->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    public function selectMethod($methodId)
    {
        $method = ContactMethod::find($methodId);
        if (!$method) return;

        $this->contacts[] = [
            'method_id' => $method->id,
            'method' => $method->title,
            'logo' => $method->logo,
            'value' => '',
            'collapsed' => false,
        ];

        $this->contactSearch = '';
        $this->searchResults = [];
    }

    public function toggleCollapse($index)
    {
        $this->contacts[$index]['collapsed'] = !$this->contacts[$index]['collapsed'];
    }

    public function removeContact($index)
    {
        try {
            DB::beginTransaction();

            $contact = $this->contacts[$index];

            // Delete from pivot using both keys
            $this->portfolio->contactMethods()
                ->where('portfolio_id', $this->portfolio->id)
                ->where('contact_method_id', $contact['method_id'])
                ->delete();

            unset($this->contacts[$index]);
            $this->contacts = array_values($this->contacts);

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete contact method.');
        }
    }


    public function saveContact($index)
    {
        $contact = $this->contacts[$index] ?? null;
        if (!$contact || empty($contact['method_id']) || empty($contact['value'])) return;

        try {
            DB::beginTransaction();

            // Check if pivot row exists
            $exists = DB::table('portfolio_contact_methods')
                ->where('portfolio_id', $this->portfolio->id)
                ->where('contact_method_id', $contact['method_id'])
                ->exists();

            if ($exists) {
                // Update
                DB::table('portfolio_contact_methods')
                    ->where('portfolio_id', $this->portfolio->id)
                    ->where('contact_method_id', $contact['method_id'])
                    ->update(['value' => $contact['value'], 'updated_at' => now()]);
            } else {
                // Insert
                DB::table('portfolio_contact_methods')->insert([
                    'portfolio_id' => $this->portfolio->id,
                    'contact_method_id' => $contact['method_id'],
                    'value' => $contact['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->contacts[$index]['collapsed'] = true;

            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save contact: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portfolio.sections.contact-section');
    }
}
