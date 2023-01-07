@props(["tooltip"])

<div {{ $attributes->merge(['class' => 'tooltip-parent']) }} {{$attributes}}><span class="tooltip hidden">{{$tooltip}}</span>{{$slot}}</div>

{{-- <x-tooltip-parent tooltip="treść tooltipu"></x-tooltip-parent> --}}
