<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MonitorA</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('assets/js/GenerateData.js') }}" defer></script>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.ui-menu-admin')

        <div class="body-wrapper">

            @include('layouts.ui-head-bar')

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="card-title">Liste des Modules</h4> <br>

                            <!-- Formulaire de recherche des modules -->
                            <div class="d-flex justify-content-end">
                                <form class="d-flex" role="search" method="GET" action="{{ route('searchUser') }}">
                                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Search" required>
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <br>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Ajouté le</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($modules->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Aucun module trouvé...</td>
                                    </tr>
                                    @else
                                    @foreach($modules as $module)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                            </div>
                                        </td>
                                        <td>{{ $module->name }}</td>
                                        <td>{{ Str::limit($module->description, 55, '...') }}</td>
                                        <td>{{ $module->date_add }}</td>
                                        <td class="d-flex gap-2">
                                            <!-- Formulaire bloquer un module -->
                                            <form action="" method="POST">
                                                <button type="submit" class="btn btn-light" title="Bloquer">
                                                    <i class="ti ti-eye" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            
                                            <!-- Bouton Modifier -->
                                            <a href="" class="btn btn-warning" title="Éditer">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <!-- Formulaire Supprimer -->
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()" title="Supprimer">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if(!$modules->isEmpty())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $modules->links('pagination::bootstrap-5') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer-js')

</body>

</html>