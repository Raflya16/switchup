@props(['options' => [], 'selected' => null, 'name' => 'category_id'])

<div x-data="{ open: false, selected: @js($selected), options: @js($options) }" class="relative">
    <button @click="open = !open" type="button" class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-primary sm:text-sm sm:leading-6">
        <span class="block truncate" x-text="selected ? options.find(o => o.id == selected)?.name : 'Pilih Kategori'"></span>
        <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 7.53 7.28a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3z" clip-rule="evenodd" />
            </svg>
        </span>
    </button>

    <ul x-show="open" @click.away="open = false" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" style="display: none;">
        @foreach($options as $option)
        <li @click="selected = {{ $option->id }}; open = false" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9 hover:bg-primary hover:text-white">
            <span class="block truncate">{{ $option->name }}</span>
        </li>
        @endforeach
    </ul>

    <input type="hidden" name="{{ $name }}" :value="selected">
</div>