<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <style>

        @font-face {
            font-family: 'main';
            src: url(/fonts/regular.woff);
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'main';
            src: url(/fonts/bold.woff);
            font-weight: bold;
            font-style: normal;
        }
        @font-face {
            font-family: 'main';
            src: url(/fonts/heavy.woff);
            font-weight: 900;
            font-style: normal;
        }

        .font-family-karla {
            font-family: 'main', serif;
        }

        .modal {
            transition: opacity 0.25s ease;
        }

        body.modal-active {
            overflow-x: hidden;
            overflow-y: visible !important;
        }
        .bg-body{
            background-color: #16163F
        }
        .bg-btn{ 
            background-color: #D3B574
        }
        .color-btn{
            color: #16163F;
            transition : all ease 0.3s
        }
        .bg-btn:hover{
            background-color: #d0aa58
        }

    </style>
</head>

<body class="bg-body font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <a href="https://grupojjinversiones.com/">
                    <img src="{{ asset('img/logo.png') }}" alt="logo jjinversion" class="h-20 w-20">
                </a>
            </div>

            @if ($errors->any())
            <div class="p-4">
                <div class="bg-red-100 p-5 w-full">
                    <div class="flex space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="flex-none fill-current text-red-500 h-4 w-4">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z" />
                        </svg>
                        <div class="leading-tight flex flex-col space-y-2">
                            <div class="text-sm font-medium text-red-700">Algo salió mal, revisa los campos por
                                favor
                            </div>
                            @foreach ($errors->all() as $error)
                                <div class="flex-1 leading-snug text-sm text-red-600">
                                    {{ $error }}
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="p-4">
                <div class="bg-green-100 p-5 w-full rounded">
                    <div class="flex justify-start">
                        <div class="flex space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="flex-none fill-current text-green-500 h-4 w-4">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                            </svg>
                            <div class="flex-1 leading-tight text-sm text-green-700 font-medium">
                                {{ session('success') }} <span id="count">5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const span = document.querySelector('#count')
                let count = 5
                let interval = setInterval(() => {

                    if (count > 0) {
                        count--;
                        span.innerHTML = count
                    } else if (count == 0) {
                        window.location.href = "https://grupojjinversiones.com/"
                    } else {
                        clearInterval(interval)
                    }
                }, 1000)

            </script>
        @endif

            <div
                class="flex flex-col text-white text-sm justify-center md:justify-start my-auto pb-8 md:pb-0 pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Calculadora Online</p>
                <p class="text-center text-md pt-4">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Mollitia ea aliquid quisquam odit dicta
                    impedit aliquam tempore! Totam error corporis impedit, nisi voluptas natus est, saepe voluptatum qui
                    fuga sed?
                </p>
                <form class="flex flex-col pt-3 md:pt-4" method="POST">
                    @csrf
                    <div class="flex flex-col pt-4">
                        <label for="name" class="text-md">Nombres</label>
                        <input type="text" id="name" name="name" placeholder="Tus nombres y apellidos"
                            value="{{ old('name') }}" required
                            class="shadow bg- appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="email" class="text-md">Correo</label>
                        <input type="email" id="email" name="email" placeholder="tu@email.com"
                            value="{{ old('email') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="phone" class="text-md">Telefono</label>
                        <input type="number" id="phone" name="phone" placeholder="999999999"
                            value="{{ old('phone') }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="mount" class="text-md">Monto Que desea Invertir ($)</label>
                        <input type="number" id="mount" name="monto" placeholder="1500.00" value="{{ old('monto') }}"
                            required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>


                    <div class="flex pt-4 items-center">
                        <input type="checkbox" name="acepto" value="1" class="mr-4" required>
                        <label for="accept" class="text-md">Acepto todos los <a href="javascript:" class="underline"
                                target="_blank">terminos y condiciones</a> </label>
                    </div>


                    <input type="submit" value="CALCULAR"
                        class="bg-btn color-btn font-bold text-lg p-2 mt-8">
                </form>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="{{ asset('img/sideCalc.jpg') }}">
        </div>
    </div>

</body>

</html>
