<div {{ $attributes->merge(['class' => 'header__icon-box']) }} {{$attributes}}>
    <x-tooltip-parent id="large-font-button" class="header__icon-box_icon header__large-font" tooltip="Zwiększ czcionkę">
        <i class="header__fontawesome fa-solid fa-a fa-3x"></i>
    </x-tooltip-parent>
    <x-tooltip-parent id="small-font-button" class="header__icon-box_icon header__small-font" tooltip="Zmniejsz czcionkę">
        <i class="header__fontawesome fa-solid fa-a fa-2xs"></i>
    </x-tooltip-parent>
    <x-tooltip-parent id="contrast-button" class="header__icon-box_icon header__contrast" tooltip="Zmień kontrast">
        <i class="header__fontawesome fa-solid fa-circle-half-stroke fa-3x contrast-button"></i>
    </x-tooltip-parent>
    <div class="header__icon-box_icon header__logged-user">
        <a href="user/{{auth()->user()->id}}">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</a>
    </div>
</div>
