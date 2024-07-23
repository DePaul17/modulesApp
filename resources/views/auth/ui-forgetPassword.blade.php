
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
    <div class="d-flex flex-column align-items-center min-vh-100">
        <div class="alert-container" style="width: 26rem; margin-top: 20px;">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>

        <div class="card-container" style="width: 26rem; margin-top: 10px;">
            <div class="card">
                <div class="card-header text-center">
                    Trouvez votre compte
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('login') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Envoyer le lien</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
