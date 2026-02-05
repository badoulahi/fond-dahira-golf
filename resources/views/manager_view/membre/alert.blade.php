@if ($errors->any())
    <div class="alert alert-danger">
        <strong>
            Failed !
        </strong>
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success">
        <strong>
            Success !
        </strong>
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <strong>
            Failed !
        </strong>
        {{ Session::get('error') }}
    </div>
@endif
