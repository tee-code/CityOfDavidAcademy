{{-- check for error --}}
@if (count($errors) > 0)

    @foreach ($errors->all() as $error)
        <div class="mt-4 alert alert-danger alert-dismissible show fade" role = "alert">{{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach

@endif

{{-- check for session --}}

@if (session('success'))
    <div class="mt-4 mb-2 alert alert-success alert-dismissible show fade" role = "alert">{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mt-4 alert alert-danger alert-dismissible show fade" role = "alert">{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
