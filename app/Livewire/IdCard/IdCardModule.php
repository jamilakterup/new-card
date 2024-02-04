<?php

namespace App\Livewire\IdCard;

use App\Models\Card;
use Livewire\Attributes\On;
use Livewire\Component;

class IdCardModule extends Component
{
    public $asignTemplate;
    public $frontImage = true;
    public $frontPageInfo = [];


    protected $listeners = ['getIdCardTemplate', 'getFrontCardData'];

    public function render()
    {
        return view('livewire.id-card.id-card-module');
    }

    public function getIdCardTemplate($tempId)
    {
        $this->asignTemplate = Card::find($tempId);
        $this->reset('frontImage');
    }

    public function activeCardImage($part)
    {
        if ($part == 'front') {
            $this->frontImage = true;
        } else {
            $this->frontImage = false;
        }
    }

    public function getFrontCardData($data)
    {
        // dd($data);
        $this->frontPageInfo = $data;
    }
}
