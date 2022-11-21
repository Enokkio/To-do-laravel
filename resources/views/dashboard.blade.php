
<head>
    @vite('resources/css/app.css')

</head>
<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="mt-3 space-y-1">
            <!-- Authentication -->
            <a href="{{ route('list.index') }}">Click THIS TO ACCESS</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

        </div>

        

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>

                <h1>
                    Posts of: {{ Auth::user()->name }}
                </h1>
                @foreach (Auth::user()->todos as $todo )
                    <h2>
                        {{ $todo->title }}
                    </h2>
                @endforeach


            </div>
        </div>
    </div>

    <a href=""><button>
        Log out</button>
    </a>
   
</x-app-layout>
