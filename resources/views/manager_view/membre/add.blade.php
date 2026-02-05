@extends('manager_view.components.layout')

@section('content')
    <div class="page-inner">

        @include('manager_view.membre.titre')

        <div class="row">
            <div class="col-md-6 ms-auto me-auto">
                <p>
                    <a class="btn btn-success" href="{{ route('membres.index') }}">Tous les membres</a>
                </p>
                @include('manager_view.components.alert')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Formulaire d'ajout de membres</div>
                    </div>
                    <form action="{{ route(name: 'membres.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="nom_complet">Nom Complet:</label>
                                        <input type="text" class="form-control" id="nom_complet" name="nom_complet"
                                            value="{{ old('nom_complet') }}" autofocus required />
                                        <span class="badge badge-info">100 caractères maximum</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="engagement">Montant Engagement:</label>
                                        <input type="number" class="form-control" id="engagement" name="engagement"
                                            value="{{ old('engagement') }}" min="5000" step="100" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
