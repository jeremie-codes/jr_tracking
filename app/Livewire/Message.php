<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commande;

class Message extends Component
{
    public $commandes;

    public function mount()
    {
        $this->loadCommandes();
    }

    public function loadCommandes()
    {
        $this->commandes = Commande::all();
    }

    public function render()
    {
        return view('livewire.message', ['commandes' => $this->commandes]);
    }
    protected $listeners = ['commandeAdded' => 'loadCommandes', 'refreshComponent' => 'loadCommandes'];

}
