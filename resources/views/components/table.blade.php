<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
        <thead class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($headers as $header)
                <th scope="col" class="px-6 py-3">
                    {{ $header }}
                </th>                    
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
      </table>
    </div>