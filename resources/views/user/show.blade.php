<x-app :tables="$tables" :table="$table">
    <x-modal-delete></x-modal-delete>
    <div class="row d-flex justify-content-center h-100 w-100 align-items-center ">
        <div class="col col-lg-7 mb-4 mb-lg-0">
            <div class="card" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="card-body">
                        <h2 class="pb-3">Viewing a User</h2>
                        <h6>Profile image</h6>
                        <div class="mt-3 mb-4 text-center w-100">
                            <img src="{{ url($record['photo'] ?? 'images/default-photo.jpg') }}" class="img-fluid" style="width: 100px;">
                        </div>
                        <h6>Information</h6>
                        <hr class="mt-0 mb-4">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <h6>Name</h6>
                                <p class="text-muted">{{$record['name']}}</p>
                            </div>
                            <div class="col-6 mb-3">
                                <h6>Email</h6>
                                <p class="text-muted">{{$record['email']}}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('tables.user.edit', ['id' => $record['id']]) }}"
                                   role="button"
                                   class="btn btn-link btn-rounded btn-sm fw-bold"
                                   data-mdb-ripple-color="primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button href="{{ route('tables.user.destroy', ['id' => $record['id']]) }}"
                                        data-mdb-toggle="modal"
                                        data-mdb-target="#confirm-modal"
                                        class="btn btn-link btn-rounded btn-sm fw-bold">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <a href="{{ route('tables.user.index') }}"
                               role="button"
                               class="btn btn-danger btn-rounded btn-sm fw-bold"
                               data-mdb-ripple-color="primary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
