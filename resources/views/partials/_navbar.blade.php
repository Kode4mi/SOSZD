<div class="navbar">
    <div class="navbar__logo" id="navbar-logo">
        <div class="navbar__logo--img">
            <a href="{{url('/tickets')}}"><span class="navbar__nazwa_1" id="navbar__nazwa1">so</span><span class="navbar__nazwa_2" id="navbar__nazwa2">SZD</span></a>
        </div>
    </div>
    <div class="navbar__sidebar">
        <ul>
            <li>
                <a href="{{url('/tickets')}}">  <button class="navbar__sidebar--button navbar__sidebar--button1">Aktualności</button> </a>
            </li>
            <li>
                <a class="main__frame--create_ticket_button" href="{{url('ticket/create')}}"> <button class="navbar__sidebar--button">Nowa Sprawa</button></a>
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
    </div>
</div>
