@extends('manager_view.components.layout')

@section('content')
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Gestion des cotisations</h3>
        </div>


        <div class="row">
            <div class="col-md-12">
                @include('manager_view.components.alert')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Liste des membres</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="cotisationsTable"
                                class="table table-bordered table-head-bg-primary table-bordered-bd-info mt-4">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th style="width: 500px;">Nom</th>
                                        @foreach ($mois as $key => $value)
                                            <th>{{ $value }}</th>
                                        @endforeach
                                        <th style="white-space: nowrap; text-align: right;">Total (F)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($membres as $membre)
                                        <tr>
                                            <td>
                                                @foreach ($membre->mensualites as $mensualite)
                                                    @if ($mensualite->annee == $selectedYear)
                                                        <button class="badge badge-primary" data-bs-toggle="modal"
                                                            data-bs-target="#addMensualite"
                                                            data-mensualite='@json($mensualite)'
                                                            data-membre="{{ $membre->nom_complet }}"
                                                            data-engagement="{{ $membre->engagement }}"
                                                            data-year="{{ $selectedYear }}">
                                                            <div class="badge badge-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </div>
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td style="white-space: nowrap; text-align: left;">
                                                {{ $membre->nom_complet }}
                                            </td>
                                            @foreach ($membre->mensualites as $mensualite)
                                                @if ($mensualite->annee == $selectedYear)
                                                    @foreach ($mois as $key => $value)
                                                        <td style="white-space: nowrap; text-align: right;">
                                                            {{ number_format($mensualite->{Str::lower($key)}, 0, '', ' ') }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            <td style="white-space: nowrap; text-align: right; font-weight: bold;">
                                                {{ number_format($mensualite->total(), 0, '', ' ') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>TOTAL</th>
                                        <th colspan="13"
                                            style="text-align: right; white-space: nowrap; font-weight: bold;">
                                            {{ number_format($total, 0, '', ' ') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addMensualite" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Mensualité du membre - <strong id="membreNom"></strong></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-header">
                        <div class="card-title">Engagement: <span id="membreEngagement"></span> F CFA</div>
                    </div>
                    <form action="{{ route('cotisation.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @foreach ($mois as $key => $value)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="form-group">
                                            <label for="{{ 'input' . $key }}">{{ $value }}</label>
                                            <input class="form-control" type="number" id="{{ 'input' . $key }}"
                                                step="500" name="mensualite[{{ Str::lower($key) }}]" placeholder="0">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="slug" id="slugInput" />
                            <input type="hidden" name="year" id="yearInput" />
                        </div>
                        <div class="row">
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var mois = {!! json_encode($mois ?? []) !!};

        // $(document).ready(function() {

        // Add Row
        $("#cotisationsTable").DataTable({
            pageLength: 100,
            order: [
                [1, 'asc']
            ],
            'ordering': true,
            'paging': true,
        });
        // });


        $(document).on('click', '.badge-primary[data-bs-toggle="modal"]', function() {
            const mensualite = $(this).data('mensualite');
            const membreNom = $(this).data('membre');
            const engagement = $(this).data('engagement')

            $('#membreNom').text(membreNom);
            $('#membreEngagement').text(engagement);

            for (var m in mois) {
                const chaine = m.toLowerCase();
                const inputValue = mensualite[chaine] || 0;
                $(`#input${m}`).val(inputValue);
            }

            $('#yearInput').val(mensualite.annee);
            $('#slugInput').val(mensualite.membre_id);
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
