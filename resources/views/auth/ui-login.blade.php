<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/monitorA.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="card shadow" style="width: 26rem;">
            <div class="card-header text-center">
                Se connecter
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.validation') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
                        </div>
                        <!-- <a href="#" class="btn btn-link">Mot de passe oublié ?</a> -->
                    </div>
                    <hr>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($errors->any())
        <div id="errorAlert" class="alert alert-danger mt-3 text-center shadow" style="width: 26rem;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>

</html>