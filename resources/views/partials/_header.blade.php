<header class="header" id="header">
    <div class="header__logged-user">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
    <div class="header__largefont"><i class="fa-solid fa-a fa-3x"></i></div>
    <div class="header__smallfont"><i class="fa-solid fa-a fa-2xs"></i></div>

    <div class="header__contrast" >
      <input type="checkbox" id="myCheckbox1" />
      <label for="myCheckbox1"> <i class="fa-solid fa-circle-half-stroke fa-3x" onClick="contrastToggle()"></i> </label>
    </div>
</header>

<script>
  var contrast=false;

  function contrastToggle(){

    if(!contrast){
    $("#navbar__nazwa1").css("color,","#29FFF4");
    $("#navbar-logo").css("background-color","#000000");
    $("#header").css("background-color","#000000");
    $("#header").css("color","#29FFF4");
    $("#main").css("background-color","#FFFFFF");
    $("#main").css("color","#0000FF");
    contrast=true;
    }
    else if(contrast)
    {
    $("#navbar__nazwa1").css("color","#8CD790");
    $("#navbar-logo").css("background-color","#508470");
    $("#header").css("background-color","#4BA68D");
    $("#header").css("color","#000000");
    $("#main").css("background-color","#D7FFF1");
    $("#main").css("color","#000000");
    contrast=false;
    }

  }
</script>
