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
