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
            <div class="card-body shadow">
              <h5 class="card-title fw-semibold mb-4">Suivi des modules</h5>
              <div class="container">
                <!-- Switch pour basculer entre les vues -->
                <div class="d-flex justify-content-end">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Mode données</label>
                  </div>
                </div>
                <br>

                <!-- Div des notifications -->
                <div id="notificationsDiv">
                  @if($details->isEmpty())
                  <div class="alert alert-info">Aucune notification pour l'instant.</div>
                  @else
                  @foreach ($details as $detail)
                  <div class="alert alert-{{ ($detail->module && $detail->module->detail && $detail->module->detail->module_state == 2) ? 'danger' : (($detail->number_data_sent < 350 && $detail->temperature > 37) ? 'warning' : (($detail->number_data_sent > 700 && $detail->temperature < 37) ? 'success' : 'light')) }}">
                    @if ($detail->module)
                    <h4>{{ $detail->module->name }}</h4>
                    <p>{{ $detail->module->description }}</p>
                    @if ($detail->module->detail && $detail->module->detail->module_state == 2)
                    <p>• En panne</p>
                    @else
                    @if ($detail->number_data_sent < 350 && $detail->temperature > 37)
                      <p>• Mauvais état</p>
                      @elseif ($detail->number_data_sent > 700 && $detail->temperature < 37)
                        <p>• Très bon état</p>
                        @else
                        <p>• État normal</p>
                        @endif
                        @endif
                        @else
                        <p>Module non trouvé</p>
                        @endif
                  </div>
                  @endforeach

                  <!-- Pagination -->
                  <div class="mt-4">
                    {{ $details->links('pagination::bootstrap-5') }}
                  </div>
                  @endif
                </div>

                <!-- Div du tableau -->
                <div id="tableDiv" style="display: none;">
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

                    <!-- Pagination -->
                    <div class="mt-4">
                      {{ $historiques->links('pagination::bootstrap-5') }}
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    @include('layouts.footer-js')

    <script src="{{ asset('assets/js/checkboxModeDonnees.js') }}"></script>

</body>

</html>