@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge([ 'class' => 'bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2 px-3' ]) }}>
    {{ $slot }}
</select>