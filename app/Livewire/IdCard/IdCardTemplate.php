<?php

namespace App\Livewire\IdCard;

use App\Models\Card;
use Livewire\Component;

class IdCardTemplate extends Component
{
    public $selectedCard;

    public function render()
    {
        $cards = Card::all();
        // dd($cards);
        return view('livewire.id-card.id-card-template', compact('cards'));
    }

    public function asignIdCard($tempId)
    {
        $this->dispatch("getIdCardTemplate", $tempId)->to(IdCardModule::class);
        if ($tempId) {
            $this->selectedCard = $tempId;
        } else {
            $this->selectedCard = null;
        }
    }
}
