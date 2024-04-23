<div>
    <header class="mb-5">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">Task Management</h1>
        </div>
    </header>

    <div class="max-w-screen-xl mx-auto border rounded-md">
        <!-- Start coding here -->
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <div class="w-1/3">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" wire:model.blur='search'
                                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search" required="">
                        </div>
                    </form>
                </div>
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <a href="{{route('tasks.management.create')}}"
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add task
                    </a>
                    <div class="flex items-center w-full space-x-3 md:w-auto">


                        <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox"
                            class="inline-flex items-center px-5 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg whitespace-nowrap hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                            type="button">Filter By <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <div id="dropdownDefaultCheckbox" wire:ignore
                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownCheckboxButton">
                                <li>
                                    <div class="flex items-center">
                                        <input id="checkbox-item-1" type="checkbox" wire:model.live='filterByTitle'
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-item-1"
                                            class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Title</label>

                                    </div>
                                    <select id="statusReference" wire:model.live='filterByTitleSort'
                                        class="block w-full p-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg px- bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="desc">Descending</option>
                                        <option value="asc">Ascending</option>
                                    </select>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <input checked id="checkbox-item-2" type="checkbox"
                                            wire:model.live='filterByCreatedAt'
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-item-2"
                                            class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Created
                                            At</label>
                                    </div>
                                    <select id="statusReference" wire:model.live='filterByCreatedAtSort'
                                        class="block w-full p-2 mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg px- bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="desc">Descending</option>
                                        <option value="asc">Ascending</option>
                                    </select>
                                </li>
                            </ul>
                        </div>


                        <label for="statusReference"
                            class="block text-sm font-medium text-gray-900 dark:text-white whitespace-nowrap">Status</label>
                        <select id="statusReference" wire:model.live='statusFilter'
                            class="block w-32 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg px- bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Status</option>
                            @foreach ($statusReferences as $key => $statusReference)
                            <option value="{{$key}}">{{$statusReference}}</option>
                            @endforeach
                        </select>
                        <label for="perPage"
                            class="block text-sm font-medium text-gray-900 dark:text-white whitespace-nowrap">Per
                            Page</label>
                        <select id="perPage" wire:model.live='perPage'
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Title</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Sub Tasks</th>
                            <th scope="col" class="px-4 py-3">Display Status</th>
                            <th scope="col" class="px-4 py-3">Created At</th>
                            <th scope="col" class="px-4 py-3">Actions
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$task->title}}</th>
                            <td class="px-4 py-3">{{$task->status->description}}</td>
                            <td class="px-4 py-3">{{ isset($task->sub_tasks) ? count($task->sub_tasks) : 0}}</td>
                            <td class="flex items-center gap-2 px-4 py-3">
                                <span>{{$task->is_draft ? 'Draft' : 'Published'}}</span>
                                @if ($task->is_draft)
                                <button type="button" wire:click='toggleDraft({{$task->id}}, 0)'
                                    class="inline-flex items-center p-1.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <span class="sr-only">Draft Task</span>
                                </button>

                                @else
                                <button type="button" wire:click='toggleDraft({{$task->id}},1)'
                                    class="inline-flex items-center p-1.5 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">

                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <span class="sr-only">Publish Task</span>
                                </button>
                                @endif

                            </td>
                            <td class="px-4 py-3">{{$task->created_at}}</td>
                            <td class="flex items-center px-4 py-3">
                                <button type="button" wire:click='loadTask({{$task->id}})'
                                    class="inline-flex items-center p-1.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <span class="sr-only">View Task</span>
                                </button>
                                <a href="{{route('tasks.management.update', $task->slug)}}"
                                    class="inline-flex items-center p-1.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                    </svg>


                                    <span class="sr-only">Edit Task</span>
                                </a>
                                <button type="button" wire:click='confirmDelete({{$task->id}})'
                                    class="inline-flex items-center p-1.5 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>

                                    <span class="sr-only">View Task</span>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{$tasks->links()}}
            </div>
        </div>
    </div>

    <x-modal wire:model.defer="viewModal" max-width="2xl">
        <x-card title="Task Details" class="overflow-y-auto" squared="true">
            <dl class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Title</dt>
                    <dd class="text-lg font-semibold">{{$taskData->title ?? ''}}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Content</dt>
                    <dd class="text-lg font-semibold">{{$taskData->content ?? ''}}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                    <dd class="text-lg font-semibold">{{$taskData->status->description ?? ''}}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Display Status</dt>
                    <dd class="text-lg font-semibold">{{ isset($taskData->is_draft) ? ($taskData->is_draft ? 'Draft' :
                        'Published') : ''}}</dd>
                </div>
                @isset($taskData->upload)
                <div class="flex flex-col py-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Attachment</dt>
                    <dd class="text-lg font-semibold">
                        @if($taskData->upload->count() > 0)
                        <div class="flex justify-center w-full">
                            <img class="w-full h-auto rounded-lg "
                                src="{{ Storage::url($taskData->upload->first()->path) }}" alt="image description">
                        </div>
                        @endif
                    </dd>
                </div>
                @endisset
                @isset($taskData->sub_tasks)
                <div class="flex flex-col pt-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Sub Tasks</dt>
                    <dd class="text-lg font-semibold">
                        <div class="flex flex-col gap-4">
                            @foreach ($taskData->sub_tasks as $subTask)
                            <div class="p-4 border rounded-md shadow-lg">
                                <dl
                                    class="divide-y divide-gray-200 w-fulltext-gray-900 dark:text-white dark:divide-gray-700">
                                    <div class="flex flex-col pb-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Title</dt>
                                        <dd class="text-lg font-semibold">{{$subTask['title']}}</dd>
                                    </div>
                                    <div class="flex flex-col py-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Content</dt>
                                        <dd class="text-lg font-semibold">{{$subTask['content']}}
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                                        <dd class="text-lg font-semibold">{{Str::headline($subTask['status'])}}</dd>
                                    </div>
                                </dl>

                            </div>
                            @endforeach
                        </div>
                    </dd>
                </div>
                @endisset
            </dl>


            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button primary label="Close" wire:click='viewModal = false' />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

</div>
