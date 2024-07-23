<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <div class="btn-group dropstart">
                <li class="nav-item dropdown">
                <button type="button" class="dropdown-toggle custom-dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('assets/images/profile/user.png') }}" alt="" width="35" height="35" class="rounded-circle">
                </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{  route('login.session') }}" method="post">
                              @csrf
                              <button class="btn btn-danger" type="submit">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </li>
              </div>
            </ul>
          </div>
        </nav>
      </header>
</body>
</html>