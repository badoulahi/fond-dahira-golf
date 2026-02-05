@extends('manager_view.components.layout')


@section('content')
    <div class="page-inner">
        <h3 class="fw-bold mb-3">Dashboard</h3>

        <div class="row">
            <div class="col-md-2">
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
                                    <h4 class="card-title">{{ number_format(125,0,'',' ') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
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
                                    <p class="card-category">Total Mois en cours</p>
                                    <h4 class="card-title">{{ number_format(300000,0,'',' ') }} F CFA</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
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
                                    <p class="card-category">Total année en cours</p>
                                    <h4 class="card-title">{{ number_format(1180000,0,'',' ') }} F CFA</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Janvier</b></h5>
                                {{-- <p class="text-muted">All Customs Value</p> --}}
                            </div>
                            <h4 class="text-success fw-bold">{{ number_format(300000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-muted mb-0">Pourcentage Récu</p>
                            <p class="text-muted mb-0">100%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Févirer</b></h5>
                                {{-- <p class="text-muted">All Customs Value</p> --}}
                            </div>
                            <h4 class="text-warning fw-bold">{{ number_format(290000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-muted mb-0">Pourcentage Récu</p>
                            <p class="text-muted mb-0">+ de 75%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Mars</b></h5>
                                {{-- <p class="text-muted">All Customs Value</p> --}}
                            </div>
                            <h4 class="text-warning fw-bold">{{ number_format(290000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-muted mb-0">Pourcentage Récu</p>
                            <p class="text-muted mb-0">+ de 75%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5><b>Avril</b></h5>
                                {{-- <p class="text-muted">All Customs Value</p> --}}
                            </div>
                            <h4 class="text-success fw-bold">{{ number_format(300000, 0, '', ' ') }} F CFA</h4>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <p class="text-muted mb-0">Pourcentage Récu</p>
                            <p class="text-muted mb-0">50%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-body skew-shadow">
                        <h1>3,072</h1>
                        <h5 class="op-8">Total conversations</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">88%</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-secondary bg-secondary-gradient">
                    <div class="card-body skew-shadow">
                        <img src="{{ asset('back-office/assets/img/visa.svg') }}" height="12.5" alt="Visa Logo" />
                        <h2 class="py-4 mb-0">1234 **** **** 5678</h2>
                        <div class="row">
                            <div class="col-8 pe-0">
                                <h3 class="fw-bold mb-1">Sultan Ghani</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    Card Holder
                                </div>
                            </div>
                            <div class="col-4 ps-0 text-end">
                                <h3 class="fw-bold mb-1">4/26</h3>
                                <div class="text-small text-uppercase fw-bold op-8">
                                    Expired
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
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Visitors</p>
                                    <h4 class="card-title">1,294</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                        <h2 class="mb-2">17</h2>
                        <p class="text-muted">Users online</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-secondary me-3">
                            <i class="fa fa-dollar-sign"></i>
                        </span>
                        <div>
                            <h5 class="mb-1">
                                <b><a href="#">132 <small>Sales</small></a></b>
                            </h5>
                            <small class="text-muted">12 waiting payments</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-success bg-success2">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end">+7%</div>
                        <h2 class="mb-2">213</h2>
                        <p>Transactions</p>
                        <div class="pull-in sparkline-fix chart-as-background">
                            <div id="lineChart6"></div>
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
    </script>
@endsection
