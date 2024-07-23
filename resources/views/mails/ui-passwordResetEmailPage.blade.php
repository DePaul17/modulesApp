<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-layout {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .email-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header-link {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .email-content {
            padding: 20px;
            text-align: center;
        }

        .confirm-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .confirm-button:hover {
            background-color: #0056b3;
        }

        .email-footer {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 10px 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="email-layout">

        <!-- Header -->
        <div class="email-header">
            <a href="{{ config('app.url') }}" class="header-link">Ma Famille</a>
        </div>

        <!-- body -->
        <div class="email-content">
            <a href="{{ $url }}" class="confirm-button">Réinitialiser mon mot de passe</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            © <script>
                document.write(new Date().getFullYear());
            </script> Ma Famille. Tous droits réservés.
        </div>

    </div>
</body>

</html>