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

    protected $rules = [
        'contacts.*.method_id' => 'required|exists:contact_methods,id',
        'contacts.*.value' => 'required|string|max:255'
    ];

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->loadExistingData();
    }

    private function loadExistingData()
    {
        if ($this->portfolio->contactMethods) {
            $this->contacts = $this->portfolio->contactMethods->map(function ($contact) {
                return [
                    'id' => $contact->id,
                    'method_id' => $contact->method_id,
                    'value' => $contact->value
                ];
            })->toArray();
        }
    }

    public function addContact()
    {
        $this->contacts[] = [
            'method_id' => '',
            'value' => ''
        ];
    }

    public function removeContact($index)
    {
        try {
            DB::beginTransaction();
            
            if (isset($this->contacts[$index]['id'])) {
                $this->portfolio->contactMethods()->where('id', $this->contacts[$index]['id'])->delete();
            }
            
            unset($this->contacts[$index]);
            $this->contacts = array_values($this->contacts);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to delete contact method.');
        }
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            
            $existingIds = collect($this->contacts)->pluck('id')->filter()->toArray();
            $this->portfolio->contactMethods()->whereNotIn('id', $existingIds)->delete();

            foreach ($this->contacts as $contact) {
                if (isset($contact['id'])) {
                    $this->portfolio->contactMethods()
                        ->where('id', $contact['id'])
                        ->update([
                            'method_id' => $contact['method_id'],
                            'value' => $contact['value']
                        ]);
                } else {
                    $this->portfolio->contactMethods()->create([
                        'method_id' => $contact['method_id'],
                        'value' => $contact['value']
                    ]);
                }
            }
            
            DB::commit();
            $this->dispatch('sectionSaved');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save contact methods.');
        }
    }

    public function render()
    {
        return view('livewire.portfolio.sections.contact-section', [
            'availableContactMethods' => ContactMethod::all()
        ]);
    }
}