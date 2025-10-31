<?php

namespace App\Livewire\Message;

use App\Models\Portfolio;
use App\Models\PortfolioMessage;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class Messages extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedPortfolio = null;


    public function setPortfolio($portfolioId = null)
    {
        $this->selectedPortfolio = $portfolioId;
        $this->resetPage();
    }

    #[Computed]
    public function portfolios()
    {
        return Portfolio::where('user_id', Auth::id())
            ->withCount(['messages' => function($query) {
                $query->where('read', false); // Count unread messages only
            }])
            ->get();
    }

    #[Computed]
    public function messages()
    {
        $portfolioIds = Portfolio::where('user_id', Auth::id())->pluck('id');
        
        return PortfolioMessage::whereIn('portfolio_id', $portfolioIds)
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('message', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedPortfolio, function($query) {
                $query->where('portfolio_id', $this->selectedPortfolio);
            })
            ->with('portfolio')
            ->latest()
            ->paginate(15);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.message.messages');
    }
}