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

const contrastToggle = (contrast) => {
    const classList = [
        "header",
        "main",
        "navbar__sidebar",
        "navbar__logo",
        "page-navigator",
        "flash-message-content",
        "login",
    ];

    if (contrast === "true") {
        localStorage.setItem('contrast', "true");
        classList.forEach((item) => {
            const currentSelector = document.querySelector(`.${item}`);

            if(currentSelector !== null)
                currentSelector.classList.add("contrast");
        });
    } else if (contrast === "false") {
        localStorage.setItem('contrast', "false");
        classList.forEach((item) => {
            const currentSelector = document.querySelector(`.${item}`);

            if(currentSelector !== null)
                currentSelector.classList.remove("contrast");
        });
    }

}

let contrast = localStorage.getItem('contrast') === "true";

contrast && contrastToggle("true");

contrast = !contrast;

document.getElementById('contrast-button').addEventListener('click', () => {
    contrast = !contrast;
    contrast ? contrastToggle("false") : contrastToggle("true");
});
