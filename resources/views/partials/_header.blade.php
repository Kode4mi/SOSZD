<div class="header" id="header">
    <div class="header__logged-user">Mikołaj Rej</div>
    <div class="header__largefont"><i class="fa-solid fa-a fa-3x"></i></div>
    <div class="header__smallfont"><i class="fa-solid fa-a fa-2xs"></i></div>
    <div class="header__contrast" ><i class="fa-solid fa-circle-half-stroke fa-3x" onClick="contrastToggle()"></i></div>
  </div>

<script>
  var contrast=0;

  function contrastToggle(){
 
    if(contrast==0)
    {
    document.getElementById("navbar__nazwa1").style.color="#29FFF4";
    document.getElementById("navbar-logo").style.backgroundColor="#000000";
    document.getElementById("header").style.backgroundColor="#000000";
    document.getElementById("header").style.color="#29FFF4";
    document.getElementById("main").style.backgroundColor="#FFFFFF"
    document.getElementById("main").style.color="#0000FF"
    contrast=1;
    }
    else if(contrast==1)
    {
    document.getElementById("navbar__nazwa1").style.color="#8CD790";
    document.getElementById("navbar-logo").style.backgroundColor="#508470";
    document.getElementById("header").style.backgroundColor="#4BA68D";
    document.getElementById("header").style.color="#000000";
    document.getElementById("main").style.backgroundColor="#D7FFF1"
    document.getElementById("main").style.color="#000000"
    contrast=0;
    }
    
  }
</script>
