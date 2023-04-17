<x-app :tables="$tables" :table="$table">
    <style>
        .gradient-custom {
            background: #f6d365;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
    <x-modal-delete></x-modal-delete>
    <div class="row d-flex justify-content-center h-100 w-100 align-items-center ">
        <div class="col col-lg-7 mb-4 mb-lg-0">
            <div class="card" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="card-body">
                        <h2 class="pb-3">Viewing a Country</h2>
                        <h6>Country flag</h6>
                        <div class="mt-3 mb-4 text-center w-100">
                            <img src="{{$record['icon'] ?? asset('images/default-photo.jpg')}}" class="img-fluid" style="width: 100px;">
                        </div>
                        <h6>Information</h6>
                        <hr class="mt-0 mb-4">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <h6>Name</h6>
                                <p class="text-muted">{{$record['name']}}</p>
                            </div>
                            <div class="col-6 mb-3">
                                <h6>Country code</h6>
                                <p class="text-muted">{{$record['code']}}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('tables.country.edit', ['id' => $record['id']]) }}"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="dark">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button href="{{ route('tables.country.destroy', ['id' => $record['id']]) }}"
                                   data-mdb-toggle="modal"
                                   data-mdb-target="#confirm-modal"
                                   class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <a href="{{ route('tables.country.index') }}"
                               role="button"
                               class="btn btn-danger btn-rounded btn-sm fw-bold"
                               data-mdb-ripple-color="dark">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
