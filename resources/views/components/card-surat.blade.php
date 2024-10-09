<div class="relative">
    <a href="{{ $href }}" class="block max-w-sm bg-white border border-gray-200 rounded-lg shadow-2xl hover:bg-green-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        @if ($exist > 0)
            <div class="w-8 h-8 bg-blue-400 rounded-full absolute top-2 right-3 flex items-center justify-center"><span class="text-white font-semibold">{{ $exist }}</span></div>
        @endif
        <div class="flex justify-center pt-2">
            <img class="rounded-t-lg h-24" src="{{ $gambar }}" alt="" />
        </div>
        <div class="p-2">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $slot }}</h5>
        </div>
    </a>
</div> 