<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>

<div class="flex ">
        
    
<main class="w-full h-full flex justify-center items-center  flex  flex-col mt-4 mb-8 content-center space-y-10 static">
    <aside class="absolute left-0 top-0">
               
        <div class="flex items-center px-2 py-3 flex-col ">
                          
            <div class=" mx-3 mt-2">
                <a href="{{ route('list.index') }}">My todos</a>
            </div>
                            
            <div class="mx-3 mt-2">
                <a href="{{ route('list.show',1) }}">All todos</a>
            </div>                
            <div class="mx-3 mt-2">
                <a href="{{ route('project.index') }}">Projects</a>
            </div>
            <div class="mx-3 mt-2">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
    
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            
            
            
    </aside>

<body class="w-full h-full flex justify-center items-center  flex  flex-col mt-4 mb-8 content-center space-y-10">
    <div class="cursor-pointer rounded-full w-16 h-16 bg-green-400 items-center flex flex-col justify-center">
        <a href="{{ route('list.create') }}"><p>Add</p></a>
    </div>

    <p class="mb-1 text-xl font-medium text-gray-900 dark:text-white pt-1">All todos</p>

    @if (session()->has('message'))
    <div class="mx-auto w-4/5 pd-10">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Warning 
        </div>
        <div class="border border-t-1 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            {{ session()->get('message') }}
        </div>
    </div>
        
    @endif

    {{-- Auth::user()->todos as $todo --}}
    @foreach ($todos as $todo )
        

    <div class="w-full max-w-xl bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 px-5">
    
        <div class="flex flex-col items-center pb-5">
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white pt-1">{{ $todo->title }}</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $todo->details }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Made By: {{ $todo->name }}</p>

            <div class="flex mt-4 space-x-1 text-sm text-black-500  ">
              <time datetime="{{ $todo->deadline }}"> Deadline: {{ $todo->deadline }} </time>
              <span aria-hidden="true"> | Priority-level: {{ $todo->priority_level }}</span>
            </div>

            @if (Auth::id() ===$todo->user_id)

            <div class="flex mt-2 space-x-3 md:mt-6">
                <form class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-red-400 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700"action="{{ route('list.destroy', [$todo->id]) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button class="" type="submit">
                        Delete
                    </button>
                </form>  
                
                <a href="{{ route('list.edit', [$todo->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-blue-400 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Edit</a>
            </div>
            @endif

        </div>
    </div>

    @endforeach 
    
        
    <div class="mx-auto pb-10 w-4/5">
        {{ $todos->links() }}
    </div>
</main>

</div>

 
</body>
</html>