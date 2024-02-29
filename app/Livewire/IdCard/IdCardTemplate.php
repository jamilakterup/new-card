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

    public function assignIdCard($tempId)
    {
        $card = Card::find($tempId);
        $this->dispatch("getIdCardTemplate", $tempId)->to(IdCardModule::class);
        $this->dispatch("loadCanvasImage", $card->front_image);
        if ($tempId) {
            $this->selectedCard = $tempId;
        } else {
            $this->selectedCard = null;
        }
    }
}
