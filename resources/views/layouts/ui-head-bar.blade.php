<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
          <!-- Button trigger modal -->
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                  <li class="px-3 py-2">
                      <form action="{{ route('login.session') }}" method="post">
                          @csrf
                          <button class="btn btn-danger w-100" type="submit">
                              Déconnexion <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                          </button>
                      </form>
                  </li>
              </ul>
            </li>
          </div>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Liste des modules <span class="bg-danger">En Panne</span></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Div des notifications -->
          <div>
            @if($modulesBrokenDown->isEmpty())
              <div class="alert alert-info">Aucun module en panne.</div>
            @else
              @foreach ($modulesBrokenDown as $moduleBrokenDown)
              <div class="alert alert-danger w-75" role="alert">
                {{ $moduleBrokenDown->name }}
              </div>
              @endforeach
            @endif  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>