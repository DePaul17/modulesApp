<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles_order.css') }}" />
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 26rem;">
                    <div class="card-header text-center">Reset Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email" value="{{ decrypt(urldecode(request('email'))) }}" readonly hidden>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirmez votre mot de passe</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Modifier le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>