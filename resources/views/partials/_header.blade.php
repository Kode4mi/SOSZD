<header class="header" id="header">
    <div class="header__icon header__large-font"><i class="fa-solid fa-a fa-3x"></i></div>
    <div class="header__icon header__small-font"><i class="fa-solid fa-a fa-2xs"></i></div>
    <div class="header__icon header__contrast" >
      <input type="checkbox" id="myCheckbox1" />
      <label for="myCheckbox1"> <i class="fa-solid fa-circle-half-stroke fa-3x contrast-button"></i> </label>
    </div>
    <div class="header__icon header__logged-user">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
</header>

<script type="text/javascript">

  document.querySelector('.contrast-button').addEventListener("click", function contrastToggle() {
      document.querySelector(".header").classList.toggle("contrast");
      document.querySelector(".main").classList.toggle("contrast");
      document.querySelector(".navbar__sidebar").classList.toggle("contrast");
      document.querySelector(".navbar__logo").classList.toggle("contrast");
      document.querySelector(".page-navigator").classList.toggle("contrast");
      document.querySelector(".flash-message-content").classList.toggle("contrast");
  });
</script>
