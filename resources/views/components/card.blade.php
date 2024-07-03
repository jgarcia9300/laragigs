{{-- esta parte del codigo es para que el componente card reciba clases de tailwindcss y se puedan agregar mas clases desde el componente padre. $attributes es una variable que se pasa por defecto. merge es un metodo de laravel que permite agregar mas clases a las que ya tiene el componente card. --}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}} 
</div>