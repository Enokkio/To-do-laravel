<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')

</head>
<body>
<div class="w-4/5 mx-auto">
    <div class="text-center pt-20">
        <h1 class="text-3xl text-gray-700">
           Add new reminder
        </h1>
        <hr class="border border-1 border-gray-300 mt-10">
    </div>

<div class="m-auto pt-20">

    <div class="pb-8">
        @if($errors->any())
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Something went wrong
            </div>
            <ul class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <form
        action="{{ route('list.store') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf

        <input
            type="text"
            name="title"
            placeholder="Title..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">

        <input
            type="text"
            name="details"
            placeholder="details..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">


            <label for="priority_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select priority</label>
            <select name="priority_id" id="priority_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a priority</option>
                @foreach ($priorities as $priority)
                <option value="{{ $priority->id }}">{{ $priority->priority_level }}</option>

                @endforeach
            </select>
            <select name="project_id" id="project_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
                <option value="">No project</option>

                @foreach ($projects as $project)
                
                <option value="{{ $project->id }}">{{ $project->title }}</option>


                @endforeach
            </select>


        <div class="bg-grey-lighter py-10">
            <label class="text-2xl" for="start">Deadline</label>

            <input type="date" id="start" name="deadline"
                   value="now"
                   min="now" max="2100-12-31">
        </div>
       
        <button
            type="submit"
            class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Submit Post
        </button>
        
    </form>
</div>
</body>
</html>