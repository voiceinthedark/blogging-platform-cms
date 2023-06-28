<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="flex max-w-md items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
        <div class="pl-3">
            <div class="text-base font-semibold">{{ $post->title }}</div>
            <div class="font-normal text-gray-500">
                @foreach ($post->tags as $tag)
                    <a href="#"
                        class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                        <x-icons.tag :name="$tag->slug" class="w-6 h-6 mx-2" />
                        {{ $tag->slug }}
                    </a>
                @endforeach
            </div>
        </div>
    </th>
    <td class="px-6 py-4 w-3/12">
        {{ $post->excerpt }}
    </td>
    <td class="px-6 py-4">
        <div class="flex items-center">
            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
            {{ $post->created_at->diffForHumans() ?? 'Unpublished' }}
        </div>
    </td>
    <td class="px-6 py-4">
        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
            Post</a>
        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline"
            wire:click="deletePost({{ $post->id }})">
            Delete Post</a>
    </td>
</tr>


