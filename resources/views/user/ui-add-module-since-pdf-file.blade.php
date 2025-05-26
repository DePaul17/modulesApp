<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MonitorA</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('layouts.ui-menu')

    <div class="body-wrapper">
      
      @include('layouts.ui-head-bar')

      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card shadow">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0">
                  Nouveau(x) module(s) avec <span class="bg-success">Agro Intelligence <i class="ti ti-wand"></i></span>
                </h5>
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <i class="fa fa-ellipsis-v" aria-hidden="true"></i> -->
                  </button>
                  <ul class="dropdown-menu">
                    <!-- Bouton modal -->
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">Comment ça marche <i class="fa fa-question" aria-hidden="true"></i></a></li>
                    <li>
                      <a class="dropdown-item" href="{{ asset('assets/docs/example_new_modules.docx') }}" download>
                        Télécharger un exemple <i class="fa fa-download" aria-hidden="true"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div><br>
              <div class="card">
                <div class="card-body shadow">
                  <form id="form-add" method="POST" action="{{ route('modules.file') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="file" class="form-label">Importer un fichier .pdf</label>
                      <input type="file" class="form-control" name="file" required>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="confirmationCheck" required>
                      <label class="form-check-label" for="confirmationCheck">Je confirme !</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Alerts -->
        @if(session('success'))
          <div id="successAlert" class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
        @if(session('warning'))
          <div id="successAlert" class="alert alert-warning" role="alert">
            {{ session('warning') }}
          </div>
        @endif
        @if(session('error'))
          <div id="errorAlert" class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Agro Intelligence, Comment ça marche</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Prout
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  
  @include('layouts.footer-js')

</body>

</html>