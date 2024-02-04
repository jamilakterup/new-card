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
                    @error('state.field_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-3">
                    <select wire:model="state.field_type" class="form-select" aria-label="Default select example">
                        <option selected>Type</option>
                        <option value="file">File</option>
                        <option value="text">Text</option>
                        <option value="email">Email</option>
                    </select>
                    @error('state.field_type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-5">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.field_value" type="text" id="input-value" class="form-control" />
                        <label class="form-label" for="input-value">Input Value</label>
                    </div>
                    @error('state.field_value') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-3">
                    <div class="form-outline" data-mdb-input-init>
                        <input wire:model="state.font_size" type="text" id="font-size" class="form-control" />
                        <label class="form-label" for="font-size">Font Size</label>
                    </div>
                    @error('state.font_size') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-3">
                    <select wire:model="state.font_type" class="form-select" aria-label="Default select example">
                        <option selected>Font Type</option>
                        <option value="bold">Bold</option>
                        <option value="regular">Regular</option>
                    </select>
                    @error('state.font_type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-3">
                    <select wire:model="state.font_family" class="form-select pe-0" aria-label="Default select example">
                        <option selected>Font Family</option>
                        <option value="sherif">Sherif</option>
                        <option value="mono">Mono</option>
                    </select>
                    @error('state.font_family') <small class="text-danger">{{ $message }}</small> @enderror
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

    <table class="table text-start my-4">
        <thead class="table-primary">
            <tr>
                <th scope="col" class="p-2 col-2">Field-Name</th>
                <th scope="col" class="p-2">Font Size</th>
                <th scope="col" class="p-2">X-Axiss</th>
                <th scope="col" class="p-2">Y-Axiss</th>
                <th scope="col" class="p-2 col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($frontPageInfo as $items)
            <tr>
                <th>{{$items['field_name']}}</th>
                <td><input type="number" id="xPosition" name="xPos" value="0" class="form-control"
                        placeholder="X-Axiss"></td>
                <td><input type="number" id="xPosition" name="xPos" value="0" class="form-control"
                        placeholder="X-Axiss"></td>
                <td> <input type="number" id="yPosition" name="yPos" value="0" class="form-control"
                        placeholder="Y-Axiss"></td>
                <td class="px-auto">
                    <i wire:click="editItem({{$items['id']}})" class="fa-solid fa-pen-to-square mt-2 me-2 fs-6"></i>
                    <i wire:click="deleteItem({{$items['id']}})" class="fa-solid fa-trash-can mt-2 fs-6"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
</div>
</div>