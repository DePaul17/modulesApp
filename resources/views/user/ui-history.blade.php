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
    
    @include('layouts.ui-menu')

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
              <h4 class="card-title">Historique des Utilisateurs</h4> <br>
              <!-- Formulaire de recherche des modules -->
              <div class="d-flex justify-content-end">
                <form class="d-flex" role="search" method="GET" action="{{ route('searchHistoricalUser') }}">
                  <input class="form-control me-2" type="search" name="query" placeholder="Rechercher..." aria-label="Search" required>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
              <br>
              <table class="table table-striped">
                  <tbody>
                      @if($historiques->isEmpty())
                          <tr>
                              <td colspan="1" class="text-center">
                                  {{ request('query') ? 'Element introuvable...' : 'Aucun historique disponible.' }}
                              </td>
                          </tr>
                      @else
                          @foreach($historiques as $historique)
                              <tr>
                                  <td>
                                      @php
                                          $userName = $historique->user->name ?? 'Utilisateur inconnu';
                                          $isCurrentUser = auth()->id() === optional($historique->user)->id;
                                      @endphp
                                      {{ $isCurrentUser ? $userName .' (Vous)' : $userName }} &nbsp;
                                      {{ $historique->action }} &nbsp;
                                      le &nbsp;
                                      {{ $historique->created_at->format('d/m/Y H:i') }}
                                  </td>
                              </tr>
                          @endforeach
                      @endif
                  </tbody>
              </table>

              <!-- Pagination -->
              @if(!$historiques->isEmpty())
                <div class="d-flex justify-content-center mt-4">
                  {{ $historiques->links('pagination::bootstrap-5') }}
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