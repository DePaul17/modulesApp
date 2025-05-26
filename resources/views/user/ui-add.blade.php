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
              <h5 class="card-title fw-semibold mb-4">Nouveau module</h5>
              <div class="card">
                <div class="card-body shadow">
                  <form id="form-add" method="POST" action="{{ route('modules.add') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Nom du module</label>
                      <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">description</label>
                      <input type="text" class="form-control" id="description" name="description" autocomplete="off">
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="confirmationCheck">
                      <label class="form-check-label" for="checkbox">Je confirme vouloir ajouter ce module !</label>
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
        @if(session('error'))
          <div id="errorAlert" class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
        @endif
      </div>
    </div>
  </div>
  
  @include('layouts.footer-js')

</body>

</html>