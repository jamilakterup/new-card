@extends('userTemplate.masters')


@section('content')

<section>
    {{-- ================ include topnav ================== --}}
    @include('userTemplate.navBar')
    {{-- main body section:: --}}
    <div class="container-fluid h-100">
        <div class="row h-100">
            {{-- side navigation bar:: --}}
            <div class="side-nav col-3 px-4 py-4 min-vh-100">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($cards as $card)
                    <div class="col">
                        <div class="card h-100">
                            <img onclick="getSingleCard({{$card->id}})" src="{{Storage::url($card->front_image)}}"
                                height="200px" width="100%" class="card-img-top" alt="card-image">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- main content section:: --}}
            <div class="col-9 py-4">
                <div class="container text-center">
                    <div class="row">
                        {{-- visible card:: --}}
                        <div class="col-5">
                            <div class="card card-template">
                                {{-- <img src="{{Storage::url($row->front_image)}}" alt=""> --}}
                            </div>
                            <div class="d-flex justify-content-center my-3">
                                <div class="box box-1"></div>
                                <div class="box"></div>
                            </div>
                        </div>

                        {{-- Card info add section:: --}}
                        <div class="col-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Front page info</h4>
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="field-name" class="form-control" />
                                                <label class="form-label" for="field-name">Field Name</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <select class="form-select py-1" aria-label="Default select example">
                                                <option selected>Type</option>
                                                <option value="1">Text</option>
                                                <option value="2">File</option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="field-value" class="form-control" />
                                                <label class="form-label" for="field-value">Field Value</label>
                                            </div>
                                        </div>
                                        <div class="col-3  my-3">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="field-value" class="form-control" />
                                                <label class="form-label" for="field-value">Font size</label>
                                            </div>
                                        </div>
                                        <div class="col-3 my-3">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="field-value" class="form-control" />
                                                <label class="form-label" for="field-value">Font Type</label>
                                            </div>
                                        </div>
                                        <div class="col-3  my-3">
                                            <div class="form-outline" data-mdb-input-init>
                                                <input type="text" id="field-value" class="form-control" />
                                                <label class="form-label" for="field-value">Font Family</label>
                                            </div>
                                        </div>
                                        <div class="col-3 my-3">
                                            <button type="button" class="btn custom-btn text-white" data-mdb-ripple-init
                                                data-mdb-ripple-color="dark">Add Field</button>
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
                                        <div class="px-3">
                                            <div class="row my-2">
                                                <div class="col-4 text-start d">ID</div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control" id="name"
                                                        placeholder="X-Axiss">
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control" id="name"
                                                        placeholder="Y-Axiss">
                                                </div>
                                                <div class="col-2 my-auto">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-4 text-start my-auto">Name</div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control" id="name"
                                                        placeholder="X-Axiss">
                                                </div>
                                                <div class="col-3">
                                                    <input type="number" class="form-control" id="name"
                                                        placeholder="Y-Axiss">
                                                </div>
                                                <div class="col-2 my-auto">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn custom-btn text-white w-50 my-5" data-mdb-ripple-init
                        data-mdb-ripple-color="dark">SUBMIT CARD</button>
                </div>
            </div>
        </div>
    </div>






</section>

@endsection