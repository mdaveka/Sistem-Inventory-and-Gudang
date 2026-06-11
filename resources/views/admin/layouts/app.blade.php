<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DANGGU')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --auth-blue: #1f3f88;
            --auth-blue-dark: #162a63;
            --auth-text: #111827;
            --auth-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--auth-text);
            background: #10204a;
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 20px;
            background-image:
                linear-gradient(90deg, rgba(10, 22, 58, .55), rgba(31, 63, 136, .18)),
                url("{{ asset('images/auth-warehouse.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        .auth-panel {
            width: min(100%, 420px);
            padding: 34px 36px;
            background: rgba(255, 255, 255, .96);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(3, 10, 30, .35);
        }

        .auth-brand {
            margin-bottom: 30px;
            text-align: center;
        }

        .auth-brand h1 {
            margin: 0;
            color: var(--auth-blue);
            font-size: 34px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .auth-brand p {
            margin: 6px 0 0;
            color: var(--auth-muted);
            font-size: 15px;
        }

        .auth-form .form-label {
            color: #374151;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-form .form-control {
            min-height: 48px;
            border-color: #d1d5db;
            border-radius: 8px;
            font-size: 15px;
        }

        .auth-form .form-control:focus {
            border-color: var(--auth-blue);
            box-shadow: 0 0 0 .2rem rgba(31, 63, 136, .15);
        }

        .auth-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 4px 0 24px;
            font-size: 14px;
        }

        .auth-options a,
        .auth-switch a {
            color: var(--auth-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-options a:hover,
        .auth-switch a:hover {
            text-decoration: underline;
        }

        .btn-auth {
            min-height: 48px;
            border: 0;
            border-radius: 8px;
            background: var(--auth-blue);
            font-weight: 800;
            letter-spacing: 0;
        }

        .btn-auth:hover,
        .btn-auth:focus {
            background: var(--auth-blue-dark);
        }

        .auth-switch {
            margin: 20px 0 0;
            color: var(--auth-muted);
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 575.98px) {
            .auth-panel {
                padding: 28px 22px;
            }

            .auth-brand h1 {
                font-size: 30px;
            }

            .auth-options {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <main class="auth-page">
        <section class="auth-panel" aria-label="@yield('title', 'DANGGU')">
            @yield('content')
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
