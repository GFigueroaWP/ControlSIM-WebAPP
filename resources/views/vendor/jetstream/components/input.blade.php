@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-csim focus:ring focus:ring-csim focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
