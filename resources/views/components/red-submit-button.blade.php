<button type="submit" class="rounded-md bg-[#f16a6f] hover:bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-sm " 

@isset($konfirmasi)
    onclick="return confirm('{{ $konfirmasi }}')"
@endisset
>{{ $slot }}</button>