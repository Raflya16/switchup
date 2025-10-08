@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-300 bg-white dark:bg-white text-gray-900 dark:text-gray-900 focus:border-primary dark:focus:border-primary-light focus:ring-primary dark:focus:ring-primary-light rounded-md shadow-sm']) !!}>