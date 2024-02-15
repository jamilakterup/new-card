<main>
    <nav class="navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-white">CARD GENERATOR</a>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn bg-light-subtle" data-mdb-ripple-init>LOG-OUT</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid h-100">
        <div class="row h-100">
            @livewire('id-card.id-card-template')

            <div class="col-9 py-4">
                <div class="container">
                    {{-- {{var_export($frontPageInfo)}} --}}
                    <div class="row">
                        <div class="col-4 ms-4">
                            <div class="card-template">
                                @if (!is_null($cardModel))
                                <img id="canvas-image"
                                    src="{{$frontImage ? Storage::url($cardModel->front_image): Storage::url($cardModel->back_image)}}"
                                    alt="card-img" class="d-none">
                                @endif
                                <div>
                                    <canvas id="myCanvas" width="204.095" height="323.53"
                                        style="transform: scale(1.2) translate(45px,28px);" class="border">

                                    </canvas>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-3" style="margin-top: 80px">
                                @if (!is_null($cardModel))
                                <img wire:click="activeCardImage('front')"
                                    src="{{Storage::url($cardModel->front_image)}}" alt="front_image"
                                    class="{{$frontImage ? 'active-card' : ''}}" role="button" height="80px"
                                    width="80px">

                                <img wire:click="activeCardImage('back')" src="{{Storage::url($cardModel->back_image)}}"
                                    alt="back_image" height="80px" width="80px" role="button"
                                    class="{{$frontImage ? '': 'active-card'}}">
                                @endif
                            </div>
                        </div>

                        {{-- @livewire('id-card.id-card-preview') --}}
                        <div class="col-7 ms-auto">
                            <div class="card">
                                @if ($frontImage)
                                <h4 class="card-title my-4 text-center">Front page info</h4>
                                @else
                                <h4 class="card-title my-4 text-center">back page info</h4>
                                @endif
                                {{-- onsubmit="getFormData(this)" --}}
                                <div class="card-body">
                                    <form wire:submit="assignCardData" class="row g-2">
                                        <div class="col-4">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input wire:model="state.field_name" type="text" id="field-name"
                                                    class="form-control" />
                                                <label class="form-label" for="field-name">Field Name</label>
                                            </div>
                                            @error('state.field_name') <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <input wire:model="state.x_pos" type="hidden" id="X-pos" value="0">
                                        <input wire:model="state.x_pos" type="hidden" id="Y-pos" value="0">
                                        <div class="col-3">
                                            <select wire:model="state.field_type" class="form-select"
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
                                                <input wire:model="state.field_value" type="text" id="input-value"
                                                    class="form-control" />
                                                <label class="form-label" for="input-value">Input Value</label>
                                            </div>
                                            @error('state.field_value') <small class="text-danger">{{ $message
                                                }}</small> @enderror
                                        </div>
                                        <div class="col-3">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input wire:model="state.font_size" type="text" id="font-size"
                                                    class="form-control" />
                                                <label class="form-label" for="font-size">Font Size</label>
                                            </div>
                                            @error('state.font_size') <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-3">
                                            <select wire:model="state.font_type" class="form-select"
                                                aria-label="Default select example">
                                                <option selected>Font Type</option>
                                                <option value="bold">Bold</option>
                                                <option value="normal">Normla</option>
                                            </select>
                                            @error('state.font_type') <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-3">
                                            <select wire:model="state.font_family" class="form-select pe-0"
                                                aria-label="Default select example">
                                                <option selected>Font Family</option>
                                                <option value="mono">Mono</option>
                                            </select>
                                            @error('state.font_family') <small class="text-danger">{{ $message
                                                }}</small> @enderror
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn custom-btn text-white ms-2"
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
                                        <th scope="col" class="p-2 col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($frontImage)
                                    @foreach ($frontPageInfo as $key => $item)
                                    <tr class="align-middle">
                                        <th>{{$item['field_name']}}</th>
                                        <td><input wire:model.live="frontPageInfo.{{$key}}.font_size" type="number"
                                                class="form-control" value="0"></td>
                                        <td><input wire:model.live.debounce.600ms="frontPageInfo.{{$key}}.x_pos"
                                                type="number" class="form-control">
                                        </td>
                                        <td> <input wire:model.live="frontPageInfo.{{$key}}.y_pos" type="number"
                                                class="form-control"></td>
                                        <td class="px-auto">
                                            <i wire:click="editItem({{$item['id']}})"
                                                class="fa-solid fa-pen-to-square me-2 fs-6"></i>
                                            <i wire:click="deleteItem({{$item['id']}})"
                                                class="fa-solid fa-trash-can fs-6"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    @foreach ($backPageInfo as $key => $item)
                                    <tr class="align-middle">
                                        <th>{{$item['field_name']}}</th>
                                        <td><input wire:model.live="backPageInfo.{{$key}}.font_size" type="number"
                                                class="form-control" value="0"></td>
                                        <td><input wire:model.live.debounce.600ms="backPageInfo.{{$key}}.x_pos"
                                                type="number" class="form-control">
                                        </td>
                                        <td> <input wire:model.live="backPageInfo.{{$key}}.y_pos" type="number"
                                                class="form-control"></td>
                                        <td class="px-auto">
                                            <i wire:click="editItem({{$item['id']}})"
                                                class="fa-solid fa-pen-to-square me-2 fs-6"></i>
                                            <i wire:click="deleteItem({{$item['id']}})"
                                                class="fa-solid fa-trash-can fs-6"></i>
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
                    <button type="submit" wire:click="saveCardInfo" class="btn btn-success w-25"
                        data-mdb-ripple-init>SUBMIT
                        CARD Info</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</main>