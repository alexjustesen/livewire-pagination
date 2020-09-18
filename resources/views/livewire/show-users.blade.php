<div>
    <div class="max-w-2xl sm:max-w-3xl space-y-4 mx-auto">
        <div class="relative rounded-md shadow-sm">
            <input wire:model.debounce.250ms="search" id="search" name="search"
                class="form-input px-6 py-4 block w-full sm:text-sm sm:leading-5 lg:text-lg" placeholder="Search">
        </div>

        <fieldset class="px-6">
            <legend class="text-base font-medium text-gray-900">
                Include in results
            </legend>

            <div class="mt-4">
                <div class="relative flex items-start">
                    <div class="flex items-center h-5">
                        <input wire:model="posts" id="posts" type="checkbox"
                            class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                    </div>
                    <div class="ml-3 text-sm leading-5">
                        <label for="posts" class="font-medium text-gray-700">Posts</label>
                        <p class="text-gray-500">Get recent posts from the users.</p>
                    </div>
                </div>
            </div>
        </fieldset>

        @if ($results)
        <div class="border rounded bg-white">
            @foreach ($results as $result)
            <div class="px-6 py-4 space-y-4 border-b last:border-b-0 hover:bg-cool-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        {{ $result->name }}
                    </div>

                    <div class="text-cool-gray-400">
                        {{ $result->email }}
                    </div>
                </div>

                @if ($result->relationLoaded('posts'))
                    <div x-data="{posts: false}" class="pl-6">
                        <div class="">
                            <ul x-show.transition.in.duration.200ms.out.duration.100ms="posts"
                                class="space-y-2">
                                @foreach ($result->posts as $post)
                                    <li class="flex items-center justify-between text-sm text-cool-gray-600">
                                        <div class="flex items-center space-x-2">
                                            <x-heroicon-o-document-text class="h-4 w-4" />
                                            <span class="truncate">{{ $post->title }}</span>
                                        </div>

                                        <div class="text-cool-gray-400">
                                            {{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <button @click="posts = !posts" class="font-semibold text-sm text-cool-gray-600">Show posts</button>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>

        {{ $results->onEachSide(1)->links() }}
        @endif
    </div>
</div>