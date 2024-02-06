
<?php

namespace App\Livewire\IdCard;


use App\Models\Card;
// use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;

class IdCardModule extends Component
{
    public $asignTemplate;
    public $frontImage = true;
    public $frontPageInfo = [];
    public $backPageInfo = [];

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

    public $state = [
        'field_name' => '',
        'x_pos' => 30,
        'y_pos' => 30,
        'field_type' => '',
        'field_value' => '',
        'font_size' => '',
        'font_type' => '',
        'font_family' => '',
    ];

    public $mode = 'add';



    protected $listeners = ['getIdCardTemplate', 'getCardData'];

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

    public function getCardData($data)
    {
        // dd($data);
        if ($this->frontImage == true) {
            $this->frontPageInfo = $data;
        } else {
            $this->backPageInfo = $data;
        }
    }



    public function updatedFrontPageInfo()
    {
        if ($this->frontImage == true) {
            $this->dispatch("getCardData", $this->frontPageInfo);
        } else {
            $this->dispatch('getCardData', $this->backPageInfo);
        }
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

    public function getBackUniqueId($backPageInfo)
    {
        if (is_array($backPageInfo) && !empty($backPageInfo)) {
            $maxId = max(array_column($backPageInfo, 'id'));
            return $maxId + 1;
        } else {
            return 1;
        }
    }


    // add items to the array
    public function assignCardData()
    {
        $this->validate();
        if ($this->frontImage == 'true') {
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
            $this->dispatch("getCardData", $this->frontPageInfo);
        } else {
            if ($this->mode == 'update') {
                $index = array_search($this->state['id'], array_column($this->backPageInfo, 'id'));
                if ($index !== false) {
                    $this->backPageInfo[$index] = $this->state;
                }
            } else {
                $newId = $this->getUniqueId($this->backPageInfo);
                $margedData = array_merge($this->state, ['id' => $newId]);
                $this->backPageInfo[] = $margedData;
            }
            $this->dispatch("getCardData", $this->backPageInfo);
        }

        $this->reset('state');
    }

    // delete function
    public function deleteItem($id)
    {
        if ($this->frontImage == 'true') {
            $filteredData = array_filter($this->frontPageInfo, fn ($item) => $item['id'] !== $id);
            $this->frontPageInfo = $filteredData;
        } else {
            $filteredData = array_filter($this->backPageInfo, fn ($item) => $item['id'] !== $id);
            $this->backPageInfo = $filteredData;
        }
    }

    public function editItem($id)
    {
        $this->mode = 'update';
        if ($this->frontImage == 'true') {
            $filteredData = array_filter($this->frontPageInfo, fn ($item) => $item['id'] === $id);
        } else {
            $filteredData = array_filter($this->backPageInfo, fn ($item) => $item['id'] === $id);
        }

        if (!empty($filteredData)) {
            $filteredData = reset($filteredData);
            $this->state = $filteredData;
        }
    }
}
