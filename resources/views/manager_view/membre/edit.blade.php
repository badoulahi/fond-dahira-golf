@extends('manager_view.components.layout')

@section('content')
    @include('manager_view.service.titre')


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Catégorie(s) non assignées</div>
                    </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categorie)
                                        <tr class="success">
                                            <td>{{ $categorie->libelle }}</td>
                                            <td class="text-center">
                                                <div class="col-xs-12"
                                                    style="display: flex; gap: 5px; align-items: center;">
                                                    <form
                                                        onclick="confirmeAcion(this, `Voulez-vous ajouté {{ $categorie->libelle }} dans ce service ?`)"
                                                        action="{{ route('services.addCategorie', [$service->id, $categorie->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="button" class="btn btn-success btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Catégorie(s) assignée(s)</div>
                    </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->categories as $categorie)
                                        <tr class="success">
                                            <td>{{ $categorie->libelle }}</td>
                                            <td class="text-center">
                                                <div class="col-xs-12"
                                                    style="display: flex; gap: 5px; align-items: center;">
                                                    <form
                                                        onclick="confirmeAcion(this, `Voulez-vous retiré {{ $categorie->libelle }} dans ce service ?`)"
                                                        action="{{ route('services.removeCategorie', [$service->id, $categorie->id]) }}"
                                                        method="POST">
                                                       @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @include('manager_view.service.alert')
                <p>
                    <a class="btn btn-success" href="{{ route('services.index') }}">Lister les services</a>
                </p>
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Formulaire de modification de service</div>
                    </div>
                    <div class="ibox-body">
                        <form role="form" action="{{ route('services.update', $service->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Nom:</label>
                                    <input type="text" class="form-control" name="nom" id="nom"
                                        value="{{ $service->nom }}" autofocus required />
                                    <span class="label label-info">50 caractères maximum</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="description" id="description" class="form-control">{{ $service->description }}</textarea>
                                <span class="label label-info">250 caractères maximum</span>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <div class="card" style="width:100%;">
                                        <img class="card-img-top"
                                            src="{{ asset('uploads/services/' . $service->avatar) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avatar">Image:</label>
                                <input type="file" name="avatar" accept="image/*" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        async function confirmeAcion(button, message) {
            const confirmed = await showConfirmButton(message)
            if (confirmed) {
                button.closest('form').submit();
            }
        }
    </script>
@endsection
