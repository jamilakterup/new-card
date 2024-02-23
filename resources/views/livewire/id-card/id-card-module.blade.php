<div>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <canvas id="myCanvas" width="204.095" height="323.53"
                    style="transform: scale(1.2) translate(45px,28px);" class="border rounded">
                </canvas>
                <div class="d-flex justify-content-center gap-3" style="margin-top: 80px">
                    @if (!is_null($cardModel))
                    <img wire:click="activeCardImage('front')" src="{{Storage::url($cardModel->front_image)}}"
                        alt="front_image" class="{{$frontImage ? 'active-card' : ''}}" role="button" height="80px"
                        width="80px">

                    <img wire:click="activeCardImage('back')" src="{{Storage::url($cardModel->back_image)}}"
                        alt="back_image" height="80px" width="80px" role="button"
                        class="{{$frontImage ? '': 'active-card'}}">
                    @endif
                </div>
            </div>

            <div class="col-8 ms-auto">
                <div class="card">
                    @if ($frontImage)
                    <h4 class="card-title my-4 text-center">Front page info</h4>
                    @else
                    <h4 class="card-title my-4 text-center">back page info</h4>
                    @endif
                    <div class="card-body">
                        <form wire:submit="assignCardData" class="row g-2">
                            <div class="col-4">
                                <div class="form-outline" data-mdb-input-init>
                                    <input wire:model="state.field_name" type="text" class="form-control" />
                                    <label class="form-label" for="field-name">Field Name</label>
                                </div>
                                @error('state.field_name') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input wire:model="state.x_pos" type="hidden" value="0">
                            <input wire:model="state.x_pos" type="hidden" value="0">
                            <div class="col-3">
                                <select wire:model.live="state.field_type" class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Type</option>
                                    <option value="text">Text</option>
                                    <option value="file">File</option>
                                </select>
                                @error('state.field_type') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-5">
                                <div class="form-outline" data-mdb-input-init>
                                    @if($state['field_type'] == 'file')
                                    <input wire:model="photo" type="file" class="form-control"
                                        accept="image/jpeg,image/png" />
                                    @else
                                    <input wire:model="state.field_value" type="text" class="form-control" />
                                    <label class="form-label" for="input-value">
                                        Input Value
                                    </label>
                                    @endif
                                </div>
                                @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('state.field_value')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-3">
                                <div class="form-outline" data-mdb-input-init>
                                    @if($state['field_type'] == 'file')
                                    <input wire:model="state.height" type="number" class="form-control" />
                                    <label class="form-label" for="height">Height</label>
                                    @else
                                    <input wire:model="state.font_size" type="text" class="form-control" />
                                    <label class="form-label" for="font-size">Font Size</label>
                                    @endif
                                </div>
                                @error('state.height') <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('state.font_size') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-3 {{ $state['field_type'] == 'file' ? 'd-block' : 'd-none' }}">
                                <div class="form-outline" data-mdb-input-init>
                                    <input wire:model="state.width" type="number" class="form-control" />
                                    <label class="form-label" for="width">Width</label>
                                </div>
                                @error('state.width')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-3 {{ $state['field_type'] == 'file' ? 'd-none' : 'd-block' }}">
                                <select wire:model="state.font_type" class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Font Type</option>
                                    <option value="bold">Bold</option>
                                    <option value="normal">Normla</option>
                                </select>
                                @error('state.font_type') <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-3 {{ $state['field_type'] == 'file' ? 'd-none' : 'd-block' }}">
                                <select wire:model="state.font_family" class="form-select pe-0"
                                    aria-label="Default select example">
                                    <option selected>Font Family</option>
                                    <option value="mono">Mono</option>
                                </select>
                                @error('state.font_family') <small class="text-danger">{{ $message
                                    }}</small> @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success mt-3" style="width:200px"
                                    data-mdb-ripple-init data-mdb-ripple-color="dark">Add
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
                            <th scope="col" class="p-2">X-Axis</th>
                            <th scope="col" class="p-2">Y-Axis</th>
                            <th scope="col" class="p-2">Height</th>
                            <th scope="col" class="p-2">Width</th>
                            <th scope="col" class="p-2 col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($frontImage)
                        @foreach ($frontPageInfo as $key => $item)
                        <tr class="align-middle">
                            <th style="padding:10px 3px 10px 8px">
                                {{$item['field_name']}}
                                @if ($item['field_name']=='img')


                                <img src="{{asset('storage/'.$item['image_url'])}}" height="10px" alt="">
                                @endif
                            </th>
                            <td style="padding:10px 3px"><input wire:model.live="frontPageInfo.{{$key}}.font_size"
                                    type="number"
                                    class="form-control {{ $item['field_type'] == 'file' ? 'd-none' : 'd-block' }}"
                                    value="0">
                            </td>
                            <td style="padding:10px 3px"><input wire:model.live="frontPageInfo.{{$key}}.x_pos"
                                    type="number" class="form-control">
                            </td>
                            <td style="padding:10px 3px"> <input wire:model.live="frontPageInfo.{{$key}}.y_pos"
                                    type="number" class="form-control">
                            </td>
                            <td style="padding:10px 3px">
                                <input wire:model.live="frontPageInfo.{{$key}}.height" type="number"
                                    class="form-control {{ $item['field_type'] == 'file' ? 'd-block' : 'd-none' }}"
                                    value="0">
                            </td>
                            <td style="padding:10px 3px">
                                <input wire:model.live="frontPageInfo.{{$key}}.width" type="number"
                                    class="form-control {{ $item['field_type'] == 'file' ? 'd-block' : 'd-none' }}"
                                    value="0">
                            </td>
                            <td style="padding:0 15px 0">
                                <i wire:click="editItem({{$item['id']}})"
                                    class="fa-solid fa-pen-to-square me-2 fs-6 text-success"></i>
                                <i wire:click="deleteItem({{$item['id']}})" class="fa-solid fa-trash-can fs-6"></i>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        @foreach ($backPageInfo as $key => $item)
                        <tr class="align-middle">
                            <th style="padding:10px 3px 10px 8px">{{$item['field_name']}}</th>
                            <td style="padding:10px 3px"><input wire:model.live="backPageInfo.{{$key}}.font_size"
                                    type="number" class="form-control" value="0">
                            </td>
                            <td style="padding:10px 3px"><input wire:model.live="backPageInfo.{{$key}}.x_pos"
                                    type="number" class="form-control">
                            </td>
                            <td style="padding:10px 3px"> <input wire:model.live="backPageInfo.{{$key}}.y_pos"
                                    type="number" class="form-control">
                            </td>
                            <td style="padding:10px 3px">
                                <input wire:model.live="backPageInfo.{{$key}}.height" type="number"
                                    class="form-control {{ $item['field_type'] == 'file' ? 'd-block' : 'd-none' }}"
                                    value="0">
                            </td>
                            <td style="padding:10px 3px">
                                <input wire:model.live="backPageInfo.{{$key}}.width" type="number"
                                    class="form-control {{ $item['field_type'] == 'file' ? 'd-block' : 'd-none' }}"
                                    value="0">
                            </td>
                            <td style="padding:0 15px 0" class="px-auto">
                                <i wire:click="editItem({{$item['id']}})"
                                    class="fa-solid fa-pen-to-square me-2 fs-6 text-success"></i>
                                <i wire:click="deleteItem({{$item['id']}})" class="fa-solid fa-trash-can fs-6"></i>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center my-5">
        <button type="submit" wire:click="saveCardInfo" class="btn btn-success w-25" data-mdb-ripple-init>SUBMIT
            CARD Info</button>
    </div>





</div>


<script>
    // alert('sdjf')
    // to make input field outline visible
    document.addEventListener('livewire:init', function() {
        Livewire.hook('morph.updated', ({ el, component }) => {
                document.querySelectorAll('.form-outline').forEach(outline => {
                    new mdb.Input(outline).init();
                });
        })
    })


document.addEventListener('livewire:init', () => {
    var imagePath = '';
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var imgEl = document.createElement("img");
    var fields = null;

    
    Livewire.on('getCardData', function(data){
        if(data[0]){
            fields = data[0];

            ctx.clearRect(0, 0, c.width, c.height);

            ctx.drawImage(imgEl,0,0,204.095,323.53);

            fillAllFields(fields, ctx);
        }
    }); 

    Livewire.on('loadCanvasImage', function(data){
        imagePath = data[0];
        
        imgEl.src = '/storage/'+imagePath
        ctx.drawImage(imgEl,0,0,204.095,323.53);
        fillAllFields(fields, ctx);
    }); 
});

function fillAllFields(fields, ctx){
    fields.forEach(item => {
            if(item['field_type']=='text'){
                let nam = item.field_value;
                let font = `${item.font_type} ${item.font_size}px ${item.font_family}`;
                ctx.font = font;
                ctx.fillText(nam, item.x_pos, item.y_pos);
            }

            if(item['field_type']=='file'){
                var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, item.x_pos, item.y_pos,item.width,item.height);
                };
                var imgPath=item['image_url'];
                img.src = '/storage/'+imgPath;
            }
        });
}

</script>