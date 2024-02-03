<?php

namespace App\Livewire\IdCard;

use Livewire\Component;
use Livewire\Attributes\Validate;

class IdCardPreview extends Component
{
    #[Validate(
        [
            'state.field_name' => 'required|max:255',
            'state.field_type' => 'required|max:255',
            'state.field_value' => 'required|max:255',
            'state.font_size' => 'required|max:255',
            'state.font_type' => 'required|max:255',
            'state.font_family' => 'required|max:255',
        ],
        null,
        null,
        [
            'state.field_name' => 'Insert field name',
            'state.field_type' => 'Select input type',
            'state.field_value' => 'Insert field value',
            'state.font_size' => 'Select font size',
            'state.font_type' => 'Select font type',
            'state.font_family' => 'Select font family',
        ]
    )]


    public $state = [];

    public $frontPageInfo = [];


    public function render()
    {
        return view('livewire.id-card.id-card-preview');
    }


    public function assignCardData()
    {
        $validatedData = $this->validate();

        $this->frontPageInfo[] = $validatedData;

        $this->reset('state');
    }
}
