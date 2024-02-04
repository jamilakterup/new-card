<?php

namespace App\Livewire\IdCard;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;

class IdCardPreview extends Component
{
    #[Validate(
        [
            'state.field_name' => 'required|max:255',
            // 'state.field_type' => 'required|max:255',
            // 'state.field_value' => 'required|max:255',
            // 'state.font_size' => 'required|max:255',
            // 'state.font_type' => 'required|max:255',
            // 'state.font_family' => 'required|max:255',
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

    public $mode = 'add';

    public $frontPageInfo = [];


    public function render()
    {
        return view('livewire.id-card.id-card-preview');
    }



    // get unique id to add or delete data
    public function getUniqueId($frontPageInfo)
    {
        if (is_array($frontPageInfo) && !empty($frontPageInfo)) {
            $maxId = max(array_column($frontPageInfo, 'id'));
            return $maxId + 1;
        } else {
            return 1;
        }
    }


    // add items to the array
    public function assignCardData()
    {
        $this->validate();
        if ($this->mode == 'update') {
            $index = array_search($this->state['id'], array_column($this->frontPageInfo, 'id'));
            if ($index !== false) {
                $this->frontPageInfo[$index] = $this->state;
            }
        } else {
            $newId = $this->getUniqueId($this->frontPageInfo);
            $margedData = array_merge($this->state, ['id' => $newId]);
            $this->frontPageInfo[] = $margedData;
        }
        $this->dispatch("getFrontCardData", $this->frontPageInfo);
        $this->reset('state');
    }

    // delete function
    public function deleteItem($id)
    {
        $filteredData = array_filter($this->frontPageInfo, fn ($item) => $item['id'] !== $id);
        $this->frontPageInfo = $filteredData;
    }

    public function editItem($id)
    {
        $this->mode = 'update';
        $filteredData = array_filter($this->frontPageInfo, fn ($item) => $item['id'] === $id);

        if (!empty($filteredData)) {
            $filteredData = reset($filteredData);
            $this->state = $filteredData;
        }
    }
}
