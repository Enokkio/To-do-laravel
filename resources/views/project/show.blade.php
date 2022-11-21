<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body >
    
    <div class="flex ">
        
    
        <main class="w-full h-full flex justify-center items-center  flex  flex-col mt-4 mb-8 content-center space-y-10 static">

            <aside class="absolute left-0 top-0">
               
                <div class="w-full h-full flex justify-center items-center  flex  flex-col mt-4 mb-8 content-center space-y-3">
                    <button id="dropdownButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-600" type="button">Project members <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
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
                    
                    <div id="dropdown" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1" aria-labelledby="dropdownButton">
                            @foreach ($projectUsers as $projectuser)

                          <li>
                              <div class="flex items-center px-2 py-3">
                          
                                  <div class="mx-3">
                                      <p class="text-gray-600 dark:text-gray-200"> {{ $projectuser->name }} </p>
                                  </div>
                                  @if (Auth::id() === $project->creator_user_id)
                                  <form action="{{ route('ProjectUser.destroy', $projectuser->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="" type="submit">
                                       <p class="text-red-600 font-bold">Remove User</p> 
                                    </button>
                                </form> 
                                  @endif                          
                              </div>
                          </li>

                          @endforeach
                          
                        </ul>
                    </div>                    
                </div>    
            </aside>


            <div class="flex space-x-9">
                @if (Auth::id() === $project->creator_user_id || $projectUsers->contains('user_id',Auth::id()))
                <div class=" rounded-md flex-1 w-64 bg-green-400 items-center flex flex-col justify-center">
                    <a href="{{ route('list.create', $project->id) }}"><p>Add todo</p></a>
                </div>
                @endif
              

                @if (Auth::id() === $project->creator_user_id)
                <div class=" rounded-md flex-1 w-32 bg-red-400 items-center flex flex-col justify-center">
                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button class="" type="submit">
                            Delete project
                        </button>
                    </form>  
                   </div>

                @endif            
                   <div>
                   
                    @if (Auth::id() === $project->creator_user_id)
                    <form action="{{ route('ProjectUser.store') }}"
                    enctype="multipart/form-data" method="POST" >
                    @method('POST')

                    @csrf
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-400 dark:text-gray-400"></label>
                        <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose user</option>

                        @foreach ($users as $user )
                       
                        @if (  $projectUsers->contains('user_id',$user->id) )
                        <option value="{{ $user->id }}">{{ $user->name }}</option> 
                            
                        @endif                    
                        @endforeach
                        </select>
                               
                    <button
                        type="submit"
                        class=" mt-15 bg-green-400 text-gray-100 text-lg font-extrabold py-2 px-4 rounded-2xl">
                        Add
                    </button>
                 </form>  
                    @endif
                    

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

        <div class="flex items-center justify-center">
            <p>Project: {{ $project->title}}</p>
        </div>
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
    
                @if (Auth::id() ===$todo->user_id || Auth::id() === $project->creator_user_id)
    
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

    
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>
</html>