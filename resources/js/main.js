import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


// Tooltip //

let tooltipParent = document.querySelectorAll(".tooltip-parent");
tooltipParent.forEach(parent => {
    parent.addEventListener('mouseenter', (event) => showTooltip(event.target))
    parent.addEventListener('mouseleave', (event) => hideTooltip(event.target))
});

const showTooltip = (tooltipParent) => {
    let tooltip = tooltipParent.querySelector('.tooltip');
    tooltip.classList.add("visible");
    tooltip.classList.remove("hidden");
}
const hideTooltip = (tooltipParent) => {
    let tooltip = tooltipParent.querySelector('.tooltip');
    tooltip.classList.remove("visible");
    tooltip.classList.add("hidden");
}

// Kontrast

const contrastToggle = (contrastState) => {
    const classList = [
        "header",
        "main",
        "navbar__sidebar",
        "navbar__logo",
        "page-navigator",
        "flash-message-content",
        "login",
    ];

    if (contrastState) {
        localStorage.setItem('contrast', "true");
        classList.forEach((item) => {
            const currentSelector = document.querySelector(`.${item}`);

            if (currentSelector !== null)
                currentSelector.classList.add("contrast");
        });
    } else {
        localStorage.setItem('contrast', "false");
        classList.forEach((item) => {
            const currentSelector = document.querySelector(`.${item}`);

            if (currentSelector !== null)
                currentSelector.classList.remove("contrast");
        });
    }

}

let contrast = localStorage.getItem('contrast') === "true";

contrast && contrastToggle(true);

contrast = !contrast;

document.getElementById('contrast-button').addEventListener('click', () => {
    contrast = !contrast;
    contrast ? contrastToggle(false) : contrastToggle(true);
});

// Font size

const root = document.querySelector(":root");

const increaseFontSize = () => {
    let fontSizeOfRoot;
    if(!localStorage.getItem('fontSize')) {
        fontSizeOfRoot = window.getComputedStyle(root, null).getPropertyValue('font-size');
        fontSizeOfRoot = parseFloat(fontSizeOfRoot);

        if (fontSizeOfRoot < 20) {
            const newFontSize = fontSizeOfRoot + 1;

            root.style.fontSize = newFontSize + "px";
            localStorage.setItem('fontSize', newFontSize.toString());
        }
    }
    else {
        fontSizeOfRoot = localStorage.getItem('fontSize');

        if (fontSizeOfRoot < 20) {
            const newFontSize = parseFloat(fontSizeOfRoot) + 1;

            root.style.fontSize = newFontSize + 'px';
            localStorage.setItem('fontSize', newFontSize.toString());
        }
    }

}

const decreaseFontSize = () => {
    let fontSizeOfRoot;
    if(!localStorage.getItem('fontSize')) {
        fontSizeOfRoot = window.getComputedStyle(root, null).getPropertyValue('font-size');
        fontSizeOfRoot = parseFloat(fontSizeOfRoot);

        if (fontSizeOfRoot > 8) {
            const newFontSize = fontSizeOfRoot - 1;

            root.style.fontSize = newFontSize + "px";
            localStorage.setItem('fontSize', newFontSize.toString());
        }
    }
    else {
        fontSizeOfRoot = localStorage.getItem('fontSize');

        if (fontSizeOfRoot > 8) {
            const newFontSize = parseFloat(fontSizeOfRoot) - 1;

            root.style.fontSize = newFontSize + 'px';
            localStorage.setItem('fontSize', newFontSize.toString());
        }
    }
}

const fontSizeFromStorage = localStorage.getItem('fontSize');

root.style.fontSize = fontSizeFromStorage + 'px';


document.getElementById('large-font-button')
    .addEventListener("click",
        () => increaseFontSize()
    );

document.getElementById('small-font-button')
    .addEventListener("click",
        () => decreaseFontSize()
    );
