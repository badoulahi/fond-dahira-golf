@extends('manager_view.components.layout')

@section('content')
    <div class="page-inner">

        @include('manager_view.membre.titre')

        <div class="row">
            <div class="col-md-12">
                <p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMembre">
                        <i class="fa fa-plus"></i>
                        Ajouter un membre
                    </button>
                </p>

                @include('manager_view.components.alert')

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Liste des membres</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom Complet</th>
                                        <th>Engagement</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nom Complet</th>
                                        <th>Engagement</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($membres as $membre)
                                        <tr>
                                            <td>{{ $membre->nom_complet }}</td>
                                            <td>{{ number_format($membre->engagement, 0, '', ' ') }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-nom="{{ $membre->nom_complet }}"
                                                        data-slug="{{ $membre->slug }}"
                                                        data-engagement="{{ $membre->engagement }}" data-bs-toggle="modal"
                                                        data-bs-target="#editMembre" class="btn btn-primary"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    {{-- <a type="" href="{{ route('membres.edit', $membre->slug) }}"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    <form action="{{ route('membres.destroy', $membre->slug) }}"
                                                        {{-- onsubmit="return confirm('Confirmer la suppression ?')" --}} method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            data-original-title="Remove"
                                                            onclick="confirmAction(this,`Voulez-vous supprimé ce service ?`)">
                                                            <i class="fa fa-trash"></i>
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
        </div>
    </div>

    <div class="modal fade" id="addMembre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-header">
                        <div class="card-title">Formulaire d'ajout de membres</div>
                    </div>
                    <form action="{{ route(name: 'membres.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="nom_complet">Nom Complet:</label>
                                        <input type="text" class="form-control" id="nom_complet" name="nom_complet"
                                            value="{{ old('nom_complet') }}" autofocus required />
                                        <span class="badge badge-info">100 caractères maximum</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="engagement">Montant Engagement:</label>
                                        <input type="number" class="form-control" id="engagement" name="engagement"
                                            value="{{ old('engagement') }}" step="500" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMembre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-header">
                        <div class="card-title">Formulaire d'ajout de membres</div>
                    </div>
                    <form action="{{ route('membres.update', 1) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="nom_complet">Nom Complet:</label>
                                        <input type="text" class="form-control" id="nom_completEdit"
                                            name="nom_complet" autofocus required />
                                        <span class="badge badge-info">100 caractères maximum</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ms-auto me-auto">
                                    <div class="form-group">
                                        <label for="engagement">Montant Engagement:</label>
                                        <input type="number" class="form-control" id="engagementEdit" name="engagement"
                                            min="5000" step="100" required />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="slug" id="slugEdit">
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Terminer</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            // Add Row
            $("#add-row").DataTable({
                pageLength: 25,
            });
        });

        $(document).on('click', '.btn-primary[data-bs-toggle="modal"]', function() {
            const engagement = $(this).data('engagement');
            const membreNom = $(this).data('nom');
            const slug = $(this).data('slug');

            // $('#membreNom').text(membreNom);
            // console.log(membreNom);

            // for (var m in mois) {
            //     const chaine = m.toLowerCase();
            //     const inputValue = mensualite[chaine] || 0;
            //     $(`#input${m}`).val(inputValue);
            // }

            $('#nom_completEdit').val(membreNom);
            $('#engagementEdit').val(engagement);
            $('#slugEdit').val(slug);
        })
    </script>
@endsection

{{-- <form action="{{ route('services.toggle', $service->slug) }}" method="POST">
    @csrf
    @method('PATCH')
    <button type="button" class="btn btn-{{ $service->etat ? 'success' : 'danger' }} btn-sm"
        onclick="confirmAction(this,`Voulez-vous activé ou desactivé ce service ?`)">
        <i class="fa fa-toggle-{{ $service->etat ? 'on' : 'off' }}"></i>
    </button>
</form>

<a href="{{ route('services.edit', $service->slug) }}" class="btn btn-success btn-sm">
    <i class="fa fa-edit"></i>
</a> --}}
