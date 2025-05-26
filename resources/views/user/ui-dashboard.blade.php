<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MonitorA</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/background.css') }}" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('layouts.ui-menu')

    <div class="body-wrapper">
      
        @include('layouts.ui-head-bar')

    </div>
  
  @include('layouts.footer-js')

</body>

</html>