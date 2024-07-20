<div class="col-span-full">
  <fieldset>
      <legend class="text-sm font-semibold leading-6 text-gray-900">{{ $slot }}</legend>
      <div class="mt-6 space-y-3">
        @foreach ($options as $option)
          <div class="flex items-center gap-x-3">
            <input id="{{ $option['id'] }}" name="{{ $name }}" value="{{ $option['value'] }}" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" @if ($checked == $option['value']) checked @endif  @if ($required) required @endif>
            <label for="{{ $option['id'] }}" class="block text-sm leading-6 text-gray-600">{{ $option['label'] }}</label>
          </div>
        @endforeach
      </div>
    </fieldset>
  </div>
  {{-- <div class="flex items-center gap-x-3">
    <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
    <label for="push-everything" class="block text-sm leading-6 text-gray-600">Everything</label>
  </div> --}}