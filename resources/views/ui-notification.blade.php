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
              <div class="container">
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