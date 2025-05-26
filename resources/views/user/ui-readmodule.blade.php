<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MonitorA</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.ui-menu')

        <div class="body-wrapper">

            @include('layouts.ui-head-bar')

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-body shadow">
                            <div class="container mb-4">
                                <!-- Formulaire de recherche des modules -->
                                <div class="d-flex justify-content-end">
                                    <form class="d-flex" role="search" method="GET" action="{{ route('moduleSearch') }}">
                                        <input class="form-control me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Search" required>
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <br>
                                @if($modules->isEmpty())
                                    <div class="alert alert-info">
                                        {{ request('query') ? 'Element introuvable...' : 'Aucun module ajouté pour l\'instant. ' }}
                                        @if(!request('query'))
                                            <a href="/add-module">Cliquer pour ajouter</a>
                                        @endif
                                    </div>
                                @else
                                    @foreach($modules as $module)
                                    <div class="card mb-3 shadow">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $module->name }}</h5>
                                            <p class="card-text">{{ $module->description }}</p>
                                            <p class="card-text">
                                                <small class="text-muted">Créé le {{ $module->created_at->format('d/m/Y') }}</small>
                                            </p>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 align-items-center p-2">
                                            <!-- Bouton Modifier -->
                                            <a href="{{ route('module.edit', $module->id) }}" class="btn btn-warning">
                                                Modifier <i class="ti ti-edit"></i>
                                            </a>

                                            <!-- Formulaire Supprimer -->
                                            <form action="{{ route('module.destroy', $module->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">
                                                    Supprimer <i class="ti ti-trash"></i>
                                                </button>
                                            </form>

                                            <!-- Boutons Conditionnels -->
                                            @if($module->starting == 1 && (!$module->detail || $module->detail->module_state != 2))
                                                <form action="{{ route('module.start', $module->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        Démarrer <i class="ti ti-reload"></i>
                                                    </button>
                                                </form>
                                            @elseif($module->starting == 2)
                                                <form action="{{ route('module.stop', $module->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        Arrêter <i class="fa fa-stop" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-success" hidden>
                                                    Démarrer <i class="ti ti-reload"></i>
                                                </button>
                                            @endif

                                            <!-- Bouton Suivre -->
                                            <a href="{{ route('module.chart', $module->id) }}" class="btn btn-primary">
                                                Graphe <i class="fa fa-chart-bar"></i>
                                            </a>

                                            <!-- Formulaire Réparer le module -->
                                            @if($module->detail && $module->detail->module_state == 2)
                                                <form action="{{ route('module.repair', $module->detail->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        Réparer le module <i class="fa fa-wrench"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $modules->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
    <button id="download_pdf" 
        style="all: unset; position: fixed; bottom: 20px; right: 20px; cursor: pointer; z-index: 1000;" 
        title="Télécharger la liste des modules">
        <img src="{{ asset('assets/images/others/download.png') }}" alt="Télécharger" 
            width="40" height="40" class="rounded-circle">
    </button>
</div>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer-js')

</body>

</html>