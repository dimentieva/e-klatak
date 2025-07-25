<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login - E-Klatak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .box-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-[#e0f7fa] min-h-screen flex items-center justify-center px-2">
    <div class="bg-white w-full max-w-5xl rounded-2xl box-shadow overflow-hidden flex flex-row transition-all duration-300 ease-in-out">

        <!-- Kiri (Logo) -->
        <div class="w-1/2 flex flex-col items-center justify-center p-4 sm:p-6 md:p-8 bg-white">
            <img src="{{ asset('assets/eklatak.png') }}" class="w-28 sm:w-30 md:w-40 h-auto object-contain mb-4" alt="Logo E-Klatak" />
            <h1 class="text-lg sm:text-xl md:text-3xl font-bold text-[#0bb4b2] text-center">E-Klatak</h1>
            <p class="text-xs sm:text-sm text-gray-600 text-center mt-1">Point Of Sales Application</p>
        </div>

        <!-- Kanan (Form Login) -->
        <div class="w-1/2 bg-[#0bb4b2] px-4 sm:px-6 py-6 sm:py-10 flex items-center justify-center rounded-r-2xl">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm space-y-5">
                @csrf

                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-center text-white">Login to Your Account</h2>

                <!-- Username -->
                <div>
                    <label class="text-white font-semibold block mb-1 text-sm">Email</label>
                    <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A9.969 9.969 0 0012 20c2.21 0 4.25-.715 5.879-1.924M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input type="text" name="email" placeholder="Enter your email"
                            class="w-full bg-transparent focus:outline-none text-gray-700 text-sm" required />
                    </div>
                </div>


                <div>
                    <label class="text-white font-semibold block mb-1 text-sm">Password</label>
                    <div class="flex items-center border border-gray-300 rounded-md px-3 py-2 bg-white relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11zm0 0v3m-6 4a9 9 0 1112 0H6z" />
                        </svg>
                        <input type="password" name="password" id="passwordInput" placeholder="Enter your password"
                            class="w-full bg-transparent focus:outline-none text-gray-700 text-sm" required />
                        <span onclick="togglePassword()" class="absolute right-3 text-gray-500 cursor-pointer">
                            <svg id="eyeIconOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.064 7-9.542 7C7.523 19 3.732 16.057 2.458 12z" />
                            </svg>
                            <svg id="eyeIconClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7
                                    a9.956 9.956 0 012.458-4.042m3.208-2.24A9.956 9.956 0 0112 5
                                    c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0
                                    01-1.334 2.472M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-2 rounded-md bg-[#00bcd4] hover:bg-[#0097a7] text-white font-bold text-sm transition duration-300">
                    Login
                </button>

                <!-- Error Message -->
                @if(session('error'))
                <div class="text-red-100 bg-red-500 text-center rounded-md px-4 py-2 text-sm">
                    {{ session('error') }}
                </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const eyeOpen = document.getElementById('eyeIconOpen');
            const eyeClosed = document.getElementById('eyeIconClosed');

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', !isPassword);
            eyeClosed.classList.toggle('hidden', isPassword);
        }
    </script>
</body>

</html>