<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-green-50 dark:hover:bg-gray-600">    
    @foreach ($row as $index => $cell)
        @if ($loop->last)
            <td class="px-6 py-4 text-right min-w-[200px]">
                <x-yellow-link-button href="{{ route('pasien.edit', ['pasien' => ]) }}">Edit</x-yellow-link-button>
                <x-blue-link-button href='/buat-surat/{{ $row[0] }}'>Buat Surat</x-blue-link-button>
            </td>
        @else
            <td class="px-6 py-4">
                {{ $cell }}
            </td>
        @endif
    @endforeach
</tr>

{{-- @foreach ($row as $index => $cell)
        @if ($loop->index == 1 )
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $cell }}
            </th>
        @elseif ($loop->last)
            <td class="px-6 py-4 text-right">
                {{ $cell }}
            </td>
        @else
            <td class="px-6 py-4">
                {{ $cell }}
            </td>
        @endif
    @endforeach --}}

