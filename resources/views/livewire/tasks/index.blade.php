<div>
    <header>
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">Dashboard</h1>
        </div>
    </header>

    <div class="p-6 mx-auto mt-6 border rounded-md max-w-screen-2xl">
        <div class="grid grid-cols-3 gap-4">
            <div class="w-full min-h-screen gap-2 p-4 border rounded-md">
                <h1 class="text-xl font-semibold text-center">To Do</h1>
                <div class="flex flex-col gap-4 mt-2">


                    @foreach ($todos as $todo)
                    <div class="w-full bg-white border rounded-lg shadow-lg">
                        <div class="flex items-center justify-between w-full p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{$todo->title}}</h3>
                                    <span
                                        class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500 truncate">{{Str::limit($todo->content, 50)}}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex -mt-px divide-x divide-gray-200">
                                <div class="flex flex-1 w-0">
                                    <button 
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                                        <!-- Heroicon name: solid/mail -->
                                        <svg class="w-5 h-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                          </svg>

                                        <span class="ml-3">View</span>
                                    </button>
                                </div>
                                <div class="flex flex-1 w-0 -ml-px">
                                    <a href="tel:+1-202-555-0170"
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                        <!-- Heroicon name: solid/phone -->
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <span class="ml-3">Call</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full min-h-screen p-4 border rounded-md">
                <h1 class="text-xl font-semibold text-center">In Progress</h1>
            </div>
            <div class="w-full min-h-screen p-4 border rounded-md">
                <h1 class="text-xl font-semibold text-center">Done</h1>
            </div>
        </div>
    </div>
</div>
