<?php

namespace App\Livewire\Message;

use App\Models\PortfolioMessage;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public PortfolioMessage $message;

    public function mount(PortfolioMessage $message)
    {
       
        $userPortfolioIds = Portfolio::where('user_id', Auth::id())->pluck('id');
        abort_if(!$userPortfolioIds->contains($message->portfolio_id), 403);
        
        $this->message = $message;
        
        if (!$this->message->read) {
            $this->message->update(['read' => true]);
        }
    }

    public function markAsUnread()
    {
        if (!$this->message) return;
        
        $this->message->update(['read' => false]);
        
    }

    public function delete()
    {
        if (!$this->message) return;

        $this->message->delete();
        $this->redirect(route('user.messages.index'));

    }


    public function render()
    {
        return view('livewire.message.view');
    }
}