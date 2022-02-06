<?php

namespace App\Http\Livewire\Pages;

use App\Models\Marketvendor;
use App\Models\User;
use Livewire\Component;

class Dash extends Component
{
    public $accountHolders;
    public $users;
    public function render()
    {
        return view('livewire.pages.dash');
    }

    public function mount()
    {
        $this->accountHolders = Marketvendor::all()->count();
        $this->users = User::all()->count();
    }


}
