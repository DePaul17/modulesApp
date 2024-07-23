<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ModulesApp</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/" class="text-nowrap logo-img">
                        <div class="image-and-text">
                            <img src="{{ asset('assets/images/logos/logo.png') }}" alt="logo" width="45" height="45">
                            <h2><b>ModulesApp</b></h2>
                        </div>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Menu</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/" aria-expanded="false">
                                <span>
                                    <i class="ti ti-list"></i>
                                </span>
                                <span class="hide-menu">Voir les modules</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/add-module" aria-expanded="false">
                                <span>
                                    <i class="ti ti-plus"></i>
                                </span>
                                <span class="hide-menu">Ajouter un module</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/notifications" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Notifications</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/history" aria-expanded="false">
                                <span>
                                    <i class="ti ti-share"></i>
                                </span>
                                <span class="hide-menu">Historique</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/validationForm.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>
</body>

</html>