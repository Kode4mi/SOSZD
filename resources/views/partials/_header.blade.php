<header class="header" id="header">
    <div class="header__icon header__large-font"><i class="header__fontawesome fa-solid fa-a fa-3x"></i></div>
    <div class="header__icon header__small-font"><i class="header__fontawesome fa-solid fa-a fa-2xs"></i></div>
    <div class="header__icon header__contrast" >
      <input class="header__checkbox" type="checkbox" id="myCheckbox1" />
      <label for="myCheckbox1"> <i class="header__fontawesome fa-solid fa-circle-half-stroke fa-3x contrast-button"></i> </label>
    </div>
    <div class="header__icon header__logged-user">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
</header>

<script type="text/javascript">
  var root = document.querySelector(":root");

  document.querySelector('.contrast-button').addEventListener("click", function contrastToggle() {
      document.querySelector(".header").classList.toggle("contrast");
      document.querySelector(".main").classList.toggle("contrast");
      document.querySelector(".navbar__sidebar").classList.toggle("contrast");
      document.querySelector(".navbar__logo").classList.toggle("contrast");
      document.querySelector(".page-navigator").classList.toggle("contrast");
      document.querySelector(".flash-message-content").classList.toggle("contrast");
  });

  document.querySelector('.header__large-font').addEventListener("click", function increaseFontSize() {
    const rootX  = document.querySelector(":root");
    let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
    fontSizeOfRoot = parseFloat(fontSizeOfRoot);
    if(fontSizeOfRoot < 20)
    rootX.style.fontSize = (fontSizeOfRoot + 1)+"px";
  });

  document.querySelector('.header__small-font').addEventListener("click", function decreaseFontSize() {
    const rootX  = document.querySelector(":root");
    let fontSizeOfRoot = window.getComputedStyle(rootX, null).getPropertyValue('font-size');
    fontSizeOfRoot = parseFloat(fontSizeOfRoot);
    if(fontSizeOfRoot > 6)
    rootX.style.fontSize = (fontSizeOfRoot - 1) +"px";
  });

</script>
