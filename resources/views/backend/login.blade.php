<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- External CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Phosphor Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
<title>ConnectAE - Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-luckydraw-gradient min-h-screen flex items-center justify-center px-4">

    @include('backend.partials.alerts')

    <div class="w-full max-w-md bg-white shadow-xl rounded-lg p-8">
        <div class="flex flex-col items-center justify-center text-center mb-8">
            <img src="{{ asset('images/logo/logo.svg') }}" class="h-12 mb-4" alt="Logo">
            <h2 class="text-3xl font-bold text-uae-accent">Welcome Back</h2>
            <p class="text-uae-secondary text-sm mt-1">Please login to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-uae-base font-medium mb-1">Email Address</label>
                <div class="flex items-center border border-gray-300 rounded px-3 py-2 focus-within:ring-2 focus-within:ring-uae-primary">
                    <i class="ph ph-envelope-simple text-uae-primary mr-2 text-lg"></i>
                    <input type="email" name="email" placeholder="you@example.com"
                        class="text-uae-accent w-full focus:outline-none" required />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-uae-base font-medium mb-1">Password</label>
                <div class="flex items-center border border-gray-300 rounded px-3 py-2 focus-within:ring-2 focus-within:ring-uae-primary">
                    <i class="ph ph-lock-key text-uae-primary mr-2 text-lg"></i>
                    <input type="password" name="password" placeholder="Enter your password"
                        class="w-full text-uae-accent focus:outline-none" required />
                </div>
            </div>

            <!-- Remember Me / Forgot -->
            <div class="flex items-center justify-between text-sm text-uae-secondary">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                        class="mr-2 rounded focus:ring-uae-primary">
                    Remember me
                </label>
                <a href="#" class="hover:underline">Forgot Password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-luckydraw-primary text-white px-4 py-2 rounded hover:opacity-90 transition shadow-md">
                <i class="ph ph-sign-in text-white text-lg mr-1"></i>
                Login
            </button>
        </form>
    </div>

    <!-- External Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
