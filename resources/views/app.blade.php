<!DOCTYPE htyml>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Calendar</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-centered">
                <li>
                    <a class="p-3" href="{{ route('index') }}">Home</a>
                </li>
                <li>
                    <a class="p-3" href="{{ route('calendar') }}">Calendar</a>
                </li>
                <li>
                    <a class="p-3" href="{{ route('events') }}">Events</a>
                </li>
            </ul>

            <ul class="flex items-centered">
                @auth
                    <li>
                        <a class="p-3" href="{{ route('user.events',auth()->user()) }}">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="inline p-3">
                            @csrf
                            <button>Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li>
                        <a class="p-3" href="{{ route('login') }}">Login</a>
                    </li>

                    <li>
                        <a class="p-3" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
            </ul>
        </nav>
        @yield('content')
    </body>
</html>
