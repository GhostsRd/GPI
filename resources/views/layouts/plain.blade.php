<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Journal des Activités</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4fbbb2;
            --primary-light: #76cfc8;
            --primary-dark: #3a8c85;
            --secondary: #f1705a;
            --secondary-light: #f48d7b;
            --secondary-dark: #cc5a48;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;
            --dark: #1e293b;
            --light: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-900: #0f172a;
            --border: #e2e8f0;
            --card-bg: #ffffff;
            --shadow-sm: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
            --shadow-md: 0 20px 27px -8px rgba(15, 23, 42, 0.12);
            --shadow-lg: 0 30px 45px -12px rgba(79, 187, 178, 0.2);
            --blur-amount: 16px;
            --gradient-primary: linear-gradient(135deg, #4fbbb2, #f1705a);
            --gradient-teal: linear-gradient(135deg, #4fbbb2, #3a8c85);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background: var(--gray-50);
            color: var(--dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
    </style>
    @livewireStyles
</head>
<body>
    <main>
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
