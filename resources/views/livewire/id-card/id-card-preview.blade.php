<div class="col-7">
    <div class="card">
        <h4 class="card-title my-4">Front page info</h4>
        {{-- onsubmit="getFormData(this)" --}}
        <div class="card-body">
            <form wire:submit="assignCardData" class="row g-2">
                <div class="col-4">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.field_name" type="text" id="field-name" class="form-control" />
                        <label class="form-label" for="field-name">Field Name</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.field_type" type="text" id="field-type" class="form-control" />
                        <label class="form-label" for="field-type">Field Type</label>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.field_value" type="text" id="input-value" class="form-control" />
                        <label class="form-label" for="input-value">Input Value</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.font_size" type="text" id="font-size" class="form-control" />
                        <label class="form-label" for="font-size">Font Size</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.font_type" type="text" id="font-type" class="form-control" />
                        <label class="form-label" for="font-type">Font Type</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.font_family" type="text" id="font-family" class="form-control" />
                        <label class="form-label" for="font-family">Font Family</label>
                    </div>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn custom-btn text-white ms-2" data-mdb-ripple-init
                        data-mdb-ripple-color="dark">Add
                        Field</button>
                </div>
            </form>
        </div>
    </div>

    {{-- inserted field:: --}}
    <div class="border px-1 my-3">
        <div class="px-2">
            <div class="row text-start custom-bg p-1 text-dark">
                <div class="col-4 fw-medium">Field Name</div>
                <div class="col-3 fw-medium">X-Axiss</div>
                <div class="col-3 fw-medium">Y-Axiss</div>
                <div class="col-2 fw-medium">Action</div>
            </div>
        </div>
        <div class="px-3" id="field-table">

            @foreach ($frontPageInfo as $items)
            {{-- {{var_dump($items['state']['field_name'])}} --}}
            <div class="row my-3">
                <div class="col-4 text-start d">{{$items['state']['field_name']}}</div>
                <div class="col-3">
                    <input type="number" id="xPosition" name="xPos" value="0" class="form-control"
                        placeholder="X-Axiss">
                </div>
                <div class="col-3">
                    <input type="number" id="yPosition" name="yPos" value="0" class="form-control"
                        placeholder="Y-Axiss">
                </div>
                <div class="col-2 my-auto">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>