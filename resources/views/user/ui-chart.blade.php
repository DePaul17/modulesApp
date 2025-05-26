<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MonitorA</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
    <script src="{{ asset('assets/js/GenerateData.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/chartModule.js') }}" defer></script>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('layouts.ui-menu')

    <div class="body-wrapper">
      
      @include('layouts.ui-head-bar')

      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <form action="{{ route('update.details') }}" method="POST" class="generateData">
                  @csrf
                  <button type="submit" class="btn btn-primary" id="btnRefresh" hidden> Actualiser </button>
              </form>
              <!-- Bouton retour -->
              <a href="/dashboard" class="btn btn-light mb-3">
                  <i class="fas fa-arrow-left"></i> Retour
              </a>
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h1 class="card-title fw-semibold">{{ $module->name }}</h1>
                  </div>
                </div>
                <h5>Suivi du module</h5>
                <canvas id="chartForModule{{ $module->id }}"
                        data-labels="{{ json_encode($labels) }}"
                        data-values="{{ json_encode($values) }}">
                </canvas>
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