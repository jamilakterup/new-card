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
                            <input type="number" class="form-control" id="name" placeholder="X-Axiss">
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control" id="name" placeholder="Y-Axiss">
                        </div>
                        <div class="col-2 my-auto">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 text-start my-auto">Name</div>
                        <div class="col-3">
                            <input type="number" class="form-control" id="name" placeholder="X-Axiss">
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control" id="name" placeholder="Y-Axiss">
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