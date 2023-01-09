<header class="header" id="header">
    <x-tooltip-parent class="header__icon header__large-font" tooltip="Zwiększ czcionkę"><i
            class="header__fontawesome fa-solid fa-a fa-3x"></i></x-tooltip-parent>
    <x-tooltip-parent class="header__icon header__small-font" tooltip="Zmniejsz czcionkę"><i
            class="header__fontawesome fa-solid fa-a fa-2xs"></i></x-tooltip-parent>
    <x-tooltip-parent id="contrast-button" class="header__icon header__contrast" tooltip="Zmień kontrast">
         <i class="header__fontawesome fa-solid fa-circle-half-stroke fa-3x contrast-button"></i>
    </x-tooltip-parent>

    <div class="header__icon header__logged-user">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
</header>

<script type="text/javascript">

    const root = document.querySelector(":root");

    document.querySelector('.header__large-font').addEventListener("click", function increaseFontSize() {
        const rootX = document.querySelector(":root");
        let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
        fontSizeOfRoot = parseFloat(fontSizeOfRoot);
        if (fontSizeOfRoot < 20)
            rootX.style.fontSize = (fontSizeOfRoot + 1) + "px";
    });

    document.querySelector('.header__small-font').addEventListener("click", function decreaseFontSize() {
        const rootX = document.querySelector(":root");
        let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
        fontSizeOfRoot = parseFloat(fontSizeOfRoot);
        if (fontSizeOfRoot > 6)
            rootX.style.fontSize = (fontSizeOfRoot - 1) + "px";
    });

</script>
