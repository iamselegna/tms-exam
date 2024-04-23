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


                    @foreach ($todos as $item)
                    <div class="w-full bg-white border rounded-lg shadow-lg">
                        <div class="flex items-center justify-between w-full p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{$item->title}}</h3>
                                    @if (isset($item->sub_tasks) && count($item->sub_tasks) > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{count($item->sub_tasks)}} Sub Tasks
                                    </span>

                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-500 truncate">{{Str::limit($item->content, 50)}}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex -mt-px divide-x divide-gray-200">
                                <div class="flex flex-1 w-0">
                                    <button wire:click='loadTask({{$item->id}})'
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                                        <!-- Heroicon name: solid/mail -->
                                        <svg class="w-5 h-5 text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <span class="ml-3">View</span>
                                    </button>
                                </div>
                                <div class="flex items-center flex-1 w-0 p-2 -ml-px" x-data="{ status: '{{$item->status}}'}">
                                    <select id="small" x-model="status"
                                        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        x-on:change="$wire.changeStatus({{$item->id}}, $event.target.value)">
                                        @foreach ($statusReferences as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full min-h-screen p-4 border rounded-md">
                <h1 class="text-xl font-semibold text-center">In Progress</h1>

                <div class="flex flex-col gap-4 mt-2">


                    @foreach ($inProgress as $item)
                    <div class="w-full bg-white border rounded-lg shadow-lg">
                        <div class="flex items-center justify-between w-full p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{$item->title}}</h3>
                                    @if (isset($item->sub_tasks) && count($item->sub_tasks) > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{count($item->sub_tasks)}} Sub Tasks
                                    </span>

                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-500 truncate">{{Str::limit($item->content, 50)}}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex -mt-px divide-x divide-gray-200">
                                <div class="flex flex-1 w-0">
                                    <button wire:click='loadTask({{$item->id}})'
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                                        <!-- Heroicon name: solid/mail -->
                                        <svg class="w-5 h-5 text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <span class="ml-3">View</span>
                                    </button>
                                </div>
                                <div class="flex items-center flex-1 w-0 p-2 -ml-px" x-data="{ status: '{{$item->status}}'}">
                                    <select id="small" x-model="status"
                                        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        x-on:change="$wire.changeStatus({{$item->id}}, $event.target.value)">
                                        @foreach ($statusReferences as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full min-h-screen p-4 border rounded-md">
                <h1 class="text-xl font-semibold text-center">Done</h1>

                <div class="flex flex-col gap-4 mt-2">


                    @foreach ($done as $item)
                    <div class="w-full bg-white border rounded-lg shadow-lg">
                        <div class="flex items-center justify-between w-full p-6 space-x-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{$item->title}}</h3>
                                    @if (isset($item->sub_tasks) && count($item->sub_tasks) > 0)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{count($item->sub_tasks)}} Sub Tasks
                                    </span>

                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-500 truncate">{{Str::limit($item->content, 50)}}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex -mt-px divide-x divide-gray-200">
                                <div class="flex flex-1 w-0">
                                    <button wire:click='loadTask({{$item->id}})'
                                        class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                                        <!-- Heroicon name: solid/mail -->
                                        <svg class="w-5 h-5 text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>

                                        <span class="ml-3">View</span>
                                    </button>
                                </div>
                                <div class="flex items-center flex-1 w-0 p-2 -ml-px"
                                    x-data="{ status: '{{$item->status}}'}">
                                    <select id="small" x-model="status"
                                        class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        x-on:change="$wire.changeStatus({{$item->id}}, $event.target.value)">
                                        @foreach ($statusReferences as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
