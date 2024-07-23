<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ModulesApp</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
  <script src="{{ asset('assets/js/GenerateData.js') }}" defer></script>
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
            <form action="{{ route('update.details') }}" method="POST" class="generateData">
                @csrf
                <button type="submit" class="btn btn-primary" id="btnRefresh" hidden> Actualiser </button>
            </form>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom du Module</th>
                            <th>Durée de l'oprt.</th>
                            <th>Nbr de données envoyés</th>
                            <th>Température</th>
                            <th>Vitesse</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiques as $historique)
                        <tr>
                            <td>{{ $historique->module->name }}</td>
                            <td>{{ $historique->detail->duration_operation }} h</td>
                            <td>{{ $historique->detail->number_data_sent }} data</td>
                            <td>{{ $historique->detail->temperature }} °</td>
                            <td>{{ $historique->detail->speed }} m/s</td>
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
  
  @include('layouts.footer-js')

</body>

</html>