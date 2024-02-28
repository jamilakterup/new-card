<?php

namespace App\Livewire\IdCard;

use App\Models\Card;
use App\Models\CardInfo;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;


class IdCardModule extends Component
{
    use WithFileUploads;
    public $cardModel;
    public $frontImage = true;
    public $frontPageInfo = [];
    public $backPageInfo = [];
    public $mode = 'add';
    public $prevPosition = [];
    public $csvFile;
    public $photo;


    #[Validate(
        [
            'state.field_name' => 'required|max:255',
            'state.field_type' => 'required|max:255',
            'state.field_value' => 'required|max:255',
        ],
        null,
        null,
        [
            'state.field_name' => 'Insert field name',
            'state.field_type' => 'Select input type',
            'state.field_value' => 'Insert field value',
        ]
    )]

    public $state = [
        'field_name' => '',
        'x_pos' => 30,
        'y_pos' => 50,
        'height' => '',
        'width' => '',
        'field_type' => '',
        'field_value' => '',
        'font_size' => '',
        'font_type' => '',
        'font_family' => '',
    ];

    protected $listeners = [
        'getIdCardTemplate',
        'getCardData',

    ];

    // render file to view
    public function render()
    {
        return view('livewire.id-card.id-card-module');
    }


    // get active card img
    public function getIdCardTemplate($tempId)
    {
        $this->cardModel = Card::find($tempId);
        $cardInfo = CardInfo::where('card_id', $tempId)->first();
        if ($cardInfo) {
            $frontPageArr = json_decode($cardInfo->front_page_info, true);
            $backPageArr = json_decode($cardInfo->back_page_info, true);

            // dd($frontPageArr, $backPageArr);
            $this->frontPageInfo = $frontPageArr;
            $this->backPageInfo = $backPageArr;
        } else {
            $this->frontPageInfo = [];
            $this->backPageInfo = [];
        }
        $this->dispatch("getCardData", $this->frontPageInfo);
        $this->reset('frontImage');
    }

    // active card
    public function activeCardImage($part)
    {
        if ($part == 'front') {
            $this->frontImage = true;
            $this->dispatch("getCardData", $this->frontPageInfo);
            $this->dispatch("loadCanvasImage", $this->cardModel->front_image);
            $this->prevPosition = [30, 50];
        } else {
            $this->frontImage = false;
            $this->dispatch("getCardData", $this->backPageInfo);
            $this->dispatch("loadCanvasImage", $this->cardModel->back_image);
            $this->prevPosition = [30, 50];
        }
    }

    // get card data
    public function getCardData($data)
    {
        if ($this->frontImage == true) {
            if ($data) {
                $this->frontPageInfo = $data;
            }
        } else {
            if ($data) {
                $this->backPageInfo = $data;
            }
        }
    }


    // update if any changes happend
    public function updatedFrontPageInfo()
    {
        if ($this->frontImage == true) {
            $this->dispatch("getCardData", $this->frontPageInfo);
            $this->prevPosition = [(int)end($this->frontPageInfo)['x_pos'], (int)end($this->frontPageInfo)['y_pos'] + 20];
        }
    }

    // update if any changes happend
    public function updatedBackPageInfo()
    {
        if ($this->frontImage == false) {
            $this->dispatch("getCardData", $this->backPageInfo);
            $this->prevPosition = [(int)end($this->backPageInfo)['x_pos'], (int)end($this->backPageInfo)['y_pos'] + 20];
        }
    }


    // // get unique id to add or delete data
    public function getUniqueId($frontPageInfo = null, $backPageInfo = null)
    {
        if ($this->frontImage == true) {
            if (is_array($frontPageInfo) && !empty($frontPageInfo)) {
                $maxId = max(array_column($frontPageInfo, 'id'));
                return $maxId + 1;
            } else {
                return 1;
            }
        } else {
            if (is_array($backPageInfo) && !empty($backPageInfo)) {
                $maxId = max(array_column($backPageInfo, 'id'));
                return $maxId + 1;
            } else {
                return 1;
            }
        }
    }



    // add items to the array
    public function assignCardData()
    {

        $this->validate();

        if ($this->frontImage == true) {
            if ($this->mode == 'update') {
                $index = array_search($this->state['id'], array_column($this->frontPageInfo, 'id'));
                if ($index !== false) {
                    $this->frontPageInfo[$index] = $this->state;
                }
            } else {
                $newId = $this->getUniqueId($this->frontPageInfo);
                if ($this->state['field_type'] == 'file' && isset($this->photo)) {
                    $image = $this->photo->getClientOriginalExtension();
                    $imgName = 'front_' . uniqid() . "." . $image;

                    $this->state['image_url'] = $this->photo->storeAs('cards', $imgName, 'public');
                }
                $margedData = array_merge($this->state, ['id' => $newId]);


                if (count($this->prevPosition)) {
                    // set prev position
                    $margedData['x_pos'] = $this->prevPosition[0];
                    $margedData['y_pos'] = $this->prevPosition[1];
                }

                //$uid=count($this->frontPageInfo)+1;

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
                $newId = $this->getUniqueId(null, $this->backPageInfo);
                if ($this->state['field_type'] == 'file' && isset($this->photo)) {
                    $image = $this->photo->getClientOriginalExtension();
                    $imgName = 'front_' . uniqid() . "." . $image;

                    $this->state['image_url'] = $this->photo->storeAs('cards', $imgName, 'public');
                }
                $margedData = array_merge($this->state, ['id' => $newId]);

                if (count($this->prevPosition)) {
                    // set prev position
                    $margedData['x_pos'] = $this->prevPosition[0];
                    $margedData['y_pos'] = $this->prevPosition[1];
                }

                $this->backPageInfo[] = $margedData;
            }
            $this->dispatch("getCardData", $this->backPageInfo);
        }
        $this->reset('state');
        $this->reset('mode');
    }

    // delete row
    public function deleteItem($id)
    {

        if ($this->frontImage == true) {
            unset($this->frontPageInfo[$id]);
            $this->frontPageInfo = array_values($this->frontPageInfo);

            $this->dispatch("getCardData", $this->frontPageInfo);
        } else {
            unset($this->backPageInfo[$id]);
            $this->backPageInfo = array_values($this->backPageInfo);
            $this->dispatch("getCardData", $this->backPageInfo);
        }
    }

    // edit row
    public function editItem($id)
    {
        $this->mode = 'update';
        if ($this->frontImage == true) {
            $filteredData = array_filter($this->frontPageInfo, fn ($item) => $item['id'] === $id);
        } else {
            $filteredData = array_filter($this->backPageInfo, fn ($item) => $item['id'] === $id);
        }

        if (!empty($filteredData)) {
            $filteredData = reset($filteredData);
            $this->state = $filteredData;
        }
    }

    // database update
    public function saveCardInfo()
    {
        // dd($this->frontPageInfo, $this->backPageInfo);

        $card = CardInfo::updateOrCreate(
            ['card_id' => $this->cardModel->id],
            [
                'front_page_info' => json_encode($this->frontPageInfo),
                'back_page_info' => json_encode($this->backPageInfo),
            ]
        );

        return redirect()->route('design/pdf', $card->card_id);
    }
}
