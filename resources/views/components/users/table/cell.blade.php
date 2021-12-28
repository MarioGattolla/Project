

@php
/** @var \Illuminate\View\ComponentAttributeBag $attributes */
@endphp

<td {{$attributes->class("px-6 py-4 whitespace-nowrap border-2 border-gray-100 rounded")}}>
    {{$slot}}
</td>
