<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Flamepilot</title>
    {{-- add favicon links --}}
    <link rel="icon" href="{{ asset('favicon/logo.ico') }}" type="image">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="font-sans">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 items-center gap-4 h-full">
            <div
                class="max-md:order-0 lg:col-span-2 w-full bg-[#000842] md:h-screen md:rounded-tr-xl md:rounded-br-xl lg:p-12 p-8">
                <img src="{{ asset('assets/img/logo.png') }}"
                    class="max-md:w-[30%] max-md:h-[80px] lg:w-[60%] md:w-[50%] h-full object-contain block mx-auto"
                    alt="Login Background" />
            </div>

            <div class="w-full p-8 max-md:order-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if ($errors->any())
                        <div
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-lg">
                            <!-- Increased text size -->
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-10"> <!-- Increased margin -->
                        <h3 class="text-gray-800 text-4xl font-extrabold">Sign in</h3> <!-- Increased font size -->
                        <p class="text-base mt-4 text-gray-800 font-bold">Selamat datang di Flamepilot</p>
                        <!-- Increased font size -->
                    </div>

                    <div>
                        <label class="text-gray-800 text-lg mb-3 block">Email</label>
                        <!-- Increased font size and margin -->
                        <div class="relative flex items-center">
                            <input name="email" type="email" required value="{{ old('email') }}"
                                class="w-full text-lg text-gray-800 bg-gray-100 focus:bg-transparent px-5 py-4 rounded-md outline-blue-600"
                                placeholder="Masukkan Email" />
                        </div>
                    </div>

                    <div class="mt-6"> <!-- Increased margin -->
                        <label class="text-gray-800 text-lg mb-3 block">Password</label>
                        <!-- Increased font size and margin -->
                        <div class="relative flex items-center">
                            <input name="password" type="password" required
                                class="w-full text-lg text-gray-800 bg-gray-100 focus:bg-transparent px-5 py-4 rounded-md outline-blue-600"
                                placeholder="Masukkan kata sandi Anda" />
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap items-center justify-between gap-4 mt-6"> <!-- Increased margin -->
                        @if (Route::has('password.request'))
                            <div>
                                <a href="{{ route('password.request') }}"
                                    class="text-blue-600 font-semibold text-base hover:underline">
                                    <!-- Increased font size -->
                                    Lupa kata sandi?
                                </a>
                            </div>
                        @endif
                    </div> --}}

                    <div class="mt-10"> <!-- Increased margin -->
                        <button type="submit"
                            class="w-full py-4 px-6 text-lg tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            <!-- Increased padding and font size -->
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
