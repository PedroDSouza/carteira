@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-sm']) !!}>