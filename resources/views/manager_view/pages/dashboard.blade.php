@extends('manager_view.components.layout')


@section('content')
    <div class="page-inner">
        <h3 class="fw-bold mb-3">Dashboard</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Adhérants</p>
                                    <h4 class="card-title">
                                        {{ number_format($statistics_annuel['totalMembre'], 0, '', ' ') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Mois en cours</p>
                                    <h6 class="fw-bold">{{ number_format($statistics_annuel['totalMensuel'], 0, '', ' ') }}
                                        F CFA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Année en cours</p>
                                    <h6 class="fw-bold ">{{ number_format($statistics_annuel['totalAnnuel'], 0, '', ' ') }}
                                        F CFA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="fw-bold mb-3">Répartition des cotisations par tranche</h3>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-black">
                    <div class="card-body pb-0">
                        <div class="h2 fw-bold float-end">
                            {{ $statistics_annuel['repartitionCotisation']['cinqmille']['pourcentage'] }} %</div>
                        <h5 class="mb-2 fw-bold">5 000 F CFA</h5>
                        <p>{{ $statistics_annuel['repartitionCotisation']['cinqmille']['nombre'] }} membres</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-primary bg-secondary-gradient">
                    <div class="card-body pb-0">
                        <div class="h2 fw-bold float-end">
                            {{ $statistics_annuel['repartitionCotisation']['dixmille']['pourcentage'] }} %</div>
                        <h5 class="mb-2 fw-bold">Entre 5K et 10K F CFA</h5>
                        <p>{{ $statistics_annuel['repartitionCotisation']['dixmille']['nombre'] }} membres</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-primary bg-primary-gradient">
                    <div class="card-body pb-0">
                        <div class="h2 fw-bold float-end">
                            {{ $statistics_annuel['repartitionCotisation']['vinghtmille']['pourcentage'] }} %</div>
                        <h5 class="mb-2 fw-bold">Entre 10K et 20K F CFA</h5>
                        <p>{{ $statistics_annuel['repartitionCotisation']['vinghtmille']['nombre'] }} membres</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-success bg-success2">
                    <div class="card-body pb-0">
                        <div class="h2 fw-bold float-end">
                            {{ $statistics_annuel['repartitionCotisation']['plus']['pourcentage'] }} %</div>
                        <h5 class="mb-2 fw-bold">+ de 20 000 F CFA</h5>
                        <p>{{ $statistics_annuel['repartitionCotisation']['plus']['nombre'] }} membres</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="fw-bold mb-3">Répartition des cotisations mensuelles</h3>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-success">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Janv</b></h5>
                            </div>
                            <h4 class="text-success fw-bold">{{ number_format(300000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-100" role="progressbar" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">100%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-warning">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Févr</b></h5>
                            </div>
                            <h4 class="text-warning fw-bold">{{ number_format(290000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-75" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 75%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-warning">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Mars</b></h5>
                            </div>
                            <h4 class="text-warning fw-bold">{{ number_format(290000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-50" role="progressbar" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 75%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-success">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Avril</b></h5>
                            </div>
                            <h4 class="text-success fw-bold">{{ number_format(300000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50" role="progressbar" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">50%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Mai</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="0"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Juin</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Juil</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Aout</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Sept</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Oct</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Nov</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-gradient">
                    <div class="card-body text-danger">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Déc</b></h5>
                            </div>
                            <h4 class="text-danger fw-bold">{{ number_format(0, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="mt-2">Pourcentage Récu</p>
                            <p class="mt-2">+ de 0%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                        <h2 class="mb-2">17</h2>
                        <p class="text-muted">Users online</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart"><canvas width="281" height="70"
                                    style="display: inline-block; width: 281.109px; height: 70px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-danger">-3%</div>
                        <h2 class="mb-2">27</h2>
                        <p class="text-muted">New Users</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart2"><canvas width="281" height="70"
                                    style="display: inline-block; width: 281.109px; height: 70px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-warning">+7%</div>
                        <h2 class="mb-2">213</h2>
                        <p class="text-muted">Transactions</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart3"><canvas width="281" height="70"
                                    style="display: inline-block; width: 281.109px; height: 70px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('javascript')
    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
@endsection
