<div class="col-7">
    <div class="card">
        <h4 class="card-title my-4 text-center">Front page info</h4>
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
                <input wire:model="state.x_pos" type="hidden" id="X-pos" value="0">
                <input wire:model="state.x_pos" type="hidden" id="Y-pos" value="0">
                <div class="col-3">
                    <select wire:model="state.field_type" class="form-select" aria-label="Default select example">
                        <option selected>Type</option>
                        <option value="text">Text</option>
                        <option value="file">File</option>
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
                        <option value="normal">Normla</option>
                    </select>
                    @error('state.font_type') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-3">
                    <select wire:model="state.font_family" class="form-select pe-0" aria-label="Default select example">
                        <option selected>Font Family</option>
                        <option value="san">Sherif</option>
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
            @foreach ($frontPageInfo as $key => $item)
            <tr class="align-middle">
                <th>{{$item['field_name']}}</th>
                <td><input wire:model.live="frontPageInfo.{{$key}}.font_size" type="number" class="form-control"
                        value="0"></td>
                <td><input wire:model.live="frontPageInfo.{{$key}}.x_pos" type="number" class="form-control">
                </td>
                <td> <input wire:model.live="frontPageInfo.{{$key}}.y_pos" type="number" class="form-control"></td>
                <td class="px-auto">
                    <i wire:click="editItem({{$item['id']}})" class="fa-solid fa-pen-to-square me-2 fs-6"></i>
                    <i wire:click="deleteItem({{$item['id']}})" class="fa-solid fa-trash-can fs-6"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
</div>
</div>


<script>
    document.addEventListener('livewire:init', () => {
    // Livewire.on('getFrontCardData', function(data){
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.clearRect(0, 0, c.width, c.height);
        var data=@json($frontPageInfo)
        console.log(data)
        data[0].forEach(item => {
        console.log(item)
            let nam = item.field_value;
            let font = `${item.font_type} ${item.font_size}px ${item.font_family}`;
            
            ctx.font = font;
            ctx.fillText(nam, item.x_pos, item.y_pos);
        });
    // });
});

</script>