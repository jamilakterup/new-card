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
                        <div class="col-5">
                            <div class="card card-template">
                                @if (!is_null($asignTemplate))
                                <img src="{{$frontImage ? Storage::url($asignTemplate->front_image): Storage::url($asignTemplate->back_image)}}"
                                    alt="card-img" height="500px" class="card-img">
                                @endif
                                <div>
                                    <canvas id="myCanvas" width="385px" height="500"
                                        class="position-absolute top-0 start-0 card-img">
                                        Your browser does not support the HTML canvas tag.
                                    </canvas>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-3 my-3">
                                @if (!is_null($asignTemplate))
                                <img wire:click="activeCardImage('front')"
                                    src="{{Storage::url($asignTemplate->front_image)}}" alt="front_image"
                                    class="{{$frontImage ? 'active-card' : ''}}" role="button" height="80px"
                                    width="80px">

                                <img wire:click="activeCardImage('back')"
                                    src="{{Storage::url($asignTemplate->back_image)}}" alt="back_image" height="80px"
                                    width="80px" role="button" class="{{$frontImage ? '': 'active-card'}}">
                                @endif
                            </div>
                        </div>

                        {{-- @livewire('id-card.id-card-preview') --}}
                        <div class="col-7">
                            <div class="card">
                                <h4 class="card-title my-4 text-center">Front page info</h4>
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
                                                <option value="san">Sherif</option>
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
                                        <th scope="col" class="p-2">X-Axiss</th>
                                        <th scope="col" class="p-2">Y-Axiss</th>
                                        <th scope="col" class="p-2 col-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

                <div class="text-center my-5">
                    <button type="button" class="btn custom-btn text-dark fw-bold w-50 p-3" data-mdb-ripple-init
                        data-mdb-ripple-color="dark">SUBMIT CARD</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</main>