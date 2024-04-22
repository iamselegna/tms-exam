<div>
    <header>
        <div class="px-4 mx-auto mb-5 max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">Create Task</h1>
        </div>
    </header>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto border rounded-lg shadow">
            <form action="#">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" wire:model.live='title'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Task title" required="">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}
                        </p>
                        @enderror
                    </div>
                    <div>

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                        <textarea rows="4" wire:model='content'
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your content here"></textarea>
                        @error('content')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}
                        </p>
                        @enderror
                    </div>
                    <div>

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload attachment</label>
                        <input wire:model='attachment'
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF (MAX. 4MB).</p>

                        @error('attachment')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}
                        </p>
                        @enderror

                        @if($attachment)
                        <img class="h-auto max-w-lg rounded-lg" src="{{$attachment->temporaryUrl()}}"
                            alt="image description">
                        @endif
                    </div>
                    <div class="w-full">
                        <button type="button" wire:click='addSubTask'
                            class="px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Add
                            Sub Task</button>
                    </div>
                    @if(count($subTasks) > 0)
                    <h1 class="font-semibold">Sub Tasks</h1>
                    @foreach ($subTasks as $idx => $subTask)
                    <div class="px-6 py-4 border rounded">
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" wire:model.live='subTasks.{{$idx}}.title'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Task title">
                            @error('subTasks.{{$idx}}.title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{$message}}
                            </p>
                            @enderror
                        </div>
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                            <textarea rows="4" wire:model.live='subTasks.{{$idx}}.content'
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your content here"></textarea>
                            @error('subTasks.{{$idx}}.content')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{$message}}
                            </p>
                            @enderror
                        </div>
                        <button type="button" wire:click='removeSubTask({{$idx}})'
                            class="mt-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Remove</button>
                    </div>
                    @endforeach
                    @endif



                </div>
                <hr class="mt-4">
                <div class="flex flex-row justify-end gap-2">
                    <a href="{{route('tasks.management.index')}}"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-800">
                        Back
                    </a>
                    <button type="button" wire:click='store(true)'
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-800">
                        Save as Draft
                    </button>
                    <button type="button" wire:click='store'
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </section>

</div>
