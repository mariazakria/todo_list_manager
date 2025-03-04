@props(['active' => false])
<li>
    <a class="{{ $active ? 'bg-white text-blue-600 px-4 py-2 rounded' : '' }}" 
       aria-current="{{ $active ? 'page' : 'false' }}" 
       {{ $attributes }}>
        {{ $slot }}
    </a>
</li>