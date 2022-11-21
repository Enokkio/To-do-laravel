<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body  >
<div class="flex ">
        
    
    <main class="w-full h-full flex justify-center items-center  flex  flex-col mt-4 mb-8 content-center space-y-10 static">
        <aside class="absolute left-0 top-0">
               
            <div class="w-full h-full flex justify-center items-center  flex  flex-col mb-8 content-center space-y-3">
                <div class="flex items-center px-2 py-3 flex-col ">
                      
                    <div class=" mx-3 ">
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
                    
                <!-- Dropdown menu -->
                                
            </div>    
        </aside>
       
       
   <div class="flex items-center justify-center ">
        <div class="cursor-pointer rounded-full w-16 h-16 bg-green-400 items-center flex flex-col justify-center">
            <a href="{{ route('project.create') }}"><p>Add</p></a>
            
        </div>
       
    </div>
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
 
  <h1  class="font-bold text-xl ">Projects</h1>
    <div class="p-1 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 ">

@foreach ( $projects as $project )
<a href="{{ route('project.show', $project->id) }}">

    <div class="p-10">  
        <!--Card 1-->
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">   
                 {{ $project->title }}
                </div>
            <p class="text-gray-700 text-base">
            Project leader: {{ $project->name }}     
              </p>
              <p class="text-gray-700 text-base">
            
            </p>
          </div>
          <div class="px-6 pt-4 pb-2">
              {{-- To be continued --}}
          </div>
        </div>
      </div>
</a>

@endforeach

        
        

      
      </div>
    </main>
</div>

    
</body>
</html>