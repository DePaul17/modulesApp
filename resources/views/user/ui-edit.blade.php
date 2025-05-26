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
            <h5 class="card-title fw-semibold mb-4">Modification...</h5>
            <div class="card shadow">
            <div class="card-body">
                    <form id="moduleForm" method="POST" action="{{ route('module.update', $module->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du module</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{ $module->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" autocomplete="off" value="{{ $module->description }}">
                        </div>
                        
                        <!-- Bouton réel pour soumettre les modifications -->
                        <button type="submit" class="btn btn-primary" id="submitButton">Modifier</button>
                        
                        <!-- Bouton Popover affiché si aucune modification n'a été faite -->
                        <a tabindex="0" class="btn btn-primary" role="button" 
                          data-bs-toggle="popover" data-bs-trigger="focus" 
                          data-bs-title="Note" 
                          data-bs-content="Aucune modification n'a été apportée dans les champs." 
                          id="popoverButton">
                          Indisponible
                        </a>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @include('layouts.footer-js')

  <script src="{{ asset('assets/js/controlInputForUpdate.js') }}"></script>

</body>

</html>