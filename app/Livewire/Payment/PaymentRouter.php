<?php

namespace App\Livewire\Payment;

use App\Http\Controllers\Payment\Processors\NowPaymentController;
use App\Http\Controllers\Payment\Processors\PolarController;
use App\Models\Plan;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentRouter extends Component
{
    public $plans;
    public $selectedPlan = null;
    public $user;
    public $paymentMethod;
    protected $nowpayment;
    protected $polar;

    public function boot()
    {
        $this->nowpayment =  new NowPaymentController();
        $this->polar = new PolarController();
    }

    public function mount(Portfolio $portfolio)
    {
        $this->plans = Plan::get();
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = Plan::find($planId);
    }

    public function removeSelectedPlan()
    {
        $this->selectedPlan = null;
    }

    public function pay()
    {
        switch ($this->paymentMethod) {
            case 'polar':
                $response =  $this->polar->process($this->selectedPlan->uid, route('user.dashboard'), route('user.dashboard'));
                break;
            case 'nowpayment':
                $response = $this->nowpayment->process($this->selectedPlan->price, route('user.dashboard'), route('user.dashboard'));
                break;
        }

        $data = json_decode($response->getContent(), true);

        $this->redirect($data['data']['invoice_url']);
    }

    public function render()
    {
        return view('livewire.payment.payment-router');
    }
}
