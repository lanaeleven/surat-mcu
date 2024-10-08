<div class="col-span-full">
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $slot }}</label>
    <div class="mt-2">
      <input type="text" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
      @if ($required) required @endif
      @if ($readonly) disabled @endif 
       >
    </div>
</div>