<x-guest-layout>
    @include('navigation-menu-guest')

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- ToastUi Viewer -->
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.min.js"></script>
    <!-- Chart plugin -->
    <script src="https://uicdn.toast.com/chart/latest/toastui-chart.min.js"></script>
    <!-- Editor -->
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <!-- Editor's chart Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-chart/latest/toastui-editor-plugin-chart.min.js"></script>
    <!-- Editor's syntax highlight Plugin -->
    <script
        src="https://uicdn.toast.com/editor-plugin-code-syntax-highlight/latest/toastui-editor-plugin-code-syntax-highlight-all.min.js">
    </script>
    <!-- Color Picker -->
    <script src="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.min.js"></script>
    <!-- Editor's color Syntax Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-color-syntax/latest/toastui-editor-plugin-color-syntax.min.js">
    </script>
    <!-- Editor's table merged cell Plugin -->
    <script
        src="https://uicdn.toast.com/editor-plugin-table-merged-cell/latest/toastui-editor-plugin-table-merged-cell.min.js">
    </script>
    <!-- Editor's UML Plugin -->
    <script src="https://uicdn.toast.com/editor-plugin-uml/latest/toastui-editor-plugin-uml.min.js"></script>


    <div class="flex flex-col items-center justify-center w-full">
        <div
            class="flex flex-col w-[80%] mx-auto justify-center items-center bg-white mt-4 px-5 py-4 shadow-lg shadow-gray-300">
            <div class="mt-8 mb-10 text-5xl font-bold tracking-tighter text-center w-96">{{ $post->title }}</div>
            <div class="flex flex-row justify-between">
                <div class="w-6/12 mr-2">
                    @foreach ($post->tags as $tag)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            <span class="text-xs">{{ $tag->slug }}</span>
                        </a>
                    @endforeach
                </div>
                <div class="w-6/12 ml-2">
                    @foreach ($post->categories as $category)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            #{{ $category->slug }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex w-full mt-8 justify-evenly">
                <a href="{{ route('profilepage.show', $post->user->userprofile->username) }}"><span
                        class="text-lg font-bold text-gray-600 hover:underline ">{{ $post->user->name }}</span></a>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex items-center justify-center w-full">
                <span class="mx-2 text-sm text-gray-500">{{ $post->word_count }} words</span>
                <span class="text-gray-500">|</span>
                <span class="mx-2 text-sm text-gray-500">{{ $post->minutes }} mins read</span>
                <span class="text-gray-500">|</span>
                <div class="flex flex-row items-center">
                    <span class="mx-2 text-sm text-gray-500">{{ $post->views }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                </div>
            </div>
            <div class="flex flex-col pb-6 mt-9">
                {{-- <article
                    class="prose lg:prose-xl md:prose-lg indent-8 prose-headings:underline prose-a:text-blue-600 hover:prose-a:text-blue-400 first-letter:font-bold first-line:uppercase prose-ol:prose-li:my-0 prose-zinc prose-ul:prose-li:my-0">
                    {!! Str::of($post->content)->markdown() !!}</article> --}}
                <div id="viewer" class="w-[80%] text-justify mx-auto">
                    {{-- {!! Str::of($post->content)->markdown() !!} --}}

                </div>
            </div>
            <!-- Likes and Dislikes section -->
            <div class="self-end mt-8">
                <livewire:post.like-form :post="$post" />
            </div>
            <x-section-border />
            <!-- About the Author and QR code section -->
            <div class="flex flex-row items-center justify-evenly">
                <div class="grid grid-cols-2 mt-8 gap-1 w-[35%] self-start">
                    <div class="row-span-2">
                        <x-avatar size="w-36 h-36" src="{{ url($post->user->userprofile->profile_photo_url) }}" />
                    </div>
                    <div>
                        <span class="text-2xl font-bold">{{ $post->user->name }}</span>
                        <span class="block text-sm text-gray-500">{{ $post->user->email }}</span>
                    </div>
                    <div>
                        <span>{{ Str::words($post->user->userProfile->bio, 10) }}</span>
                    </div>
                </div>
                <!-- Page QR Code -->
                <div class="justify-self-end">
                    {!! QrCode::generate(Request::url('/posts/' . $post->slug)) !!}
                </div>
            </div>

        </div>
        <!-- Comments section -->
        <div class="mt-8 bg-white shadow rounded px-4 py-4 w-[50%]">
            <div class="flex justify-between">
                <span class="text-2xl font-bold">Comments</span>
                <span class="font-semibold">{{ $post->comments->count() }} comments</span>
            </div>
            <x-section-border />
            <livewire:comments.show-comments :comments="$comments" :post="$post" />
        </div>
    </div>




    <script >
        let content = {!! json_encode($post->content) !!};
        // console.log(content);
        const {
        Editor
        } = toastui;

        const {
        chart,
        codeSyntaxHighlight,
        colorSyntax,
        tableMergedCell,
        uml,

        } = Editor.plugin;

        const Viewer = toastui.Editor;

        const viewer = Editor.factory({
        el: document.querySelector('#viewer'),
        height: '600px',
        viewer: true,
        // initialValue: content,
        plugins: [
        [chart],
        [codeSyntaxHighlight, {
        highlighter: Prism
        }], colorSyntax, tableMergedCell, uml
        ],

        });

        viewer.setMarkdown(content);

        // Echo.channel('post.show').listen("App\\Events\\SendPostContent", (e) => {
        // // alert(JSON.stringify(e));
        // content=e;
        // viewer.setMarkDown(content);
        // });

            // viewer.setMarkdown(content);


        // Pusher.logToConsole = true;

        // var pusher = new Pusher('7a6a88741d1cb64c3f64', {
        // cluster: 'ap1'
        // });

        // var channel = pusher.subscribe('post.show');
        // channel.bind('pusher:subscription_succeeded', function(members) {
        //     // console.log(members);
        //     });
        // channel.bind("App\\Events\\SendPostContent", function(data) {
        //     alert(JSON.stringify(data));
        //     content = data;
        //     viewer.setMarkdown(data);
        // });




    </script>


</x-guest-layout>
