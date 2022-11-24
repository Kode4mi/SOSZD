<header class="header" id="header">
    <div class="header__icon header__largefont"><i class="fa-solid fa-a fa-3x"></i></div>
    <div class="header__icon header__smallfont"><i class="fa-solid fa-a fa-2xs"></i></div>
    <div class="header__icon header__contrast" >
      <input type="checkbox" id="myCheckbox1" />
      <label for="myCheckbox1"> <i class="fa-solid fa-circle-half-stroke fa-3x" onClick="contrastToggle()"></i> </label>
    </div>
    <div class="header__icon header__logged-user">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
</header>

<script>
  function contrastToggle(){
  $(".header").toggleClass("contrast");
  $(".main").toggleClass("contrast");
  $(".navbar__sidebar").toggleClass("contrast");
  $(".navbar__logo").toggleClass("contrast");
  }
</script>
