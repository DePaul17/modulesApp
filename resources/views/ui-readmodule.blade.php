<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ModulesApp</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.ui-menu')

        <div class="body-wrapper">

            @include('layouts.ui-head-bar')

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="container mb-4">
                                @if($modules->isEmpty())
                                <div class="alert alert-info">Aucun module ajouté pour l'instant. <a href="/add-module">Cliquer pour ajouter</a> </div>
                                @else
                                @foreach($modules as $module)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $module->name }}</h5>
                                        <p class="card-text">{{ $module->description }}</p>
                                        <p class="card-text"><small class="text-muted">Créé le {{ $module->created_at->format('d/m/Y') }}</small></p>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
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
                                                Arrêter
                                            </button>
                                        </form>
                                        @else
                                        <button type="button" class="btn btn-success" disabled>
                                            Démarrer <i class="ti ti-reload"></i>
                                        </button>
                                        @endif

                                        <!-- Bouton Suivre -->
                                        <a href="{{ route('module.chart', $module->id) }}" class="btn btn-primary">
                                            Suivre <i class="ti ti-eye"></i>
                                        </a>

                                        <!-- Formulaire Réparer le module -->
                                        @if($module->detail && $module->detail->module_state == 2)
                                        <form action="{{ route('module.repair', $module->detail->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Réparer le module <i class="ti ti-panel"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    @include('layouts.footer-js')

</body>

</html>