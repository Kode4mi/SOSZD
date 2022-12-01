<nav class="navbar">
    <div class="navbar__logo" id="navbar-logo">
        <div class="navbar__logo--img">
            <a href="{{url('/tickets')}}">  <img src="{{asset('images/logo-smallest.png')}}" alt="soSZD logo" > </a>
        </div>
    </div>
    <aside class="navbar__sidebar">
        <ul>
            <li>
                <a href="{{url('/tickets')}}">  <button class="navbar__sidebar--button navbar__sidebar--button1">Aktualności</button> </a>
            </li>
            <li>
                <a class="main__frame--create_ticket_button" href="{{url('ticket/create')}}"> <button class="navbar__sidebar--button">Nowa Sprawa</button></a>
            </li>
            <li>
                <a class="main__frame--archive_button" href="{{url('/archives')}}"> <button class="navbar__sidebar--button navbar__sidebar--button_archive">Archiwum</button></a>
            </li>
            <li>
                @if(auth()->user()->role === 'admin')
                    <form action="/users" method="GET"><button class="navbar__sidebar--button">Użytkownicy</button></form>
                @else
                    <form action="/user/edit" method="GET"><button class="navbar__sidebar--button">Konto</button></form>
                @endif
            </li>
            <li>
                <form action="/logout" method="POST"> @csrf @method("POST") <button type="submit" class="navbar__sidebar--button">Wyloguj</button> </form>
            </li>
        </ul>
    </aside>

    <!-- tymczasowo to tutaj dodaje, bo nie wiem zbytnio gdzie -->
    <div class="navbar__hamburger">
        <i class="fa-solid fa-bars"></i>
    </div>

    <script type="text/javascript">
        const hamburger = document.querySelector(".navbar__hamburger");
        const navbar = document.querySelector(".navbar");
        hamburger.addEventListener("click", ()=>{
            navbar.classList.toggle("navbar--moved");
        });
    </script>
</nav>
