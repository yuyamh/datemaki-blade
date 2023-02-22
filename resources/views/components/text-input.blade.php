@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-transparent focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
