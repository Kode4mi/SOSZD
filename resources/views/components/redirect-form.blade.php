<form class="redirect-form" action="/redirect/{{$ticket->id}}" method="POST">

    @csrf
    @method("POST")

    <label>
        <input class="user-input" oninput="updateResult(this.value)" type="text" placeholder="Szukaj Adresata" />
    </label>

    <label>Wybrani użytkownicy:</label>
    <p class="selected-list"></p>


    <label class="label_adresat" for="user_select">Adresaci:</label>
    <ul class="redirect-form__select" multiple id="user_list">
        @foreach($users as $user)
            <li class="redirect-form__option" value="{{$user->id}}"
                onclick="addToSelected({{$user->id}})"> {{$user->first_name}} {{$user->last_name}} </li>
        @endforeach
    </ul>

    <script type="text/javascript">

        let arr = document.getElementsByClassName("redirect-form__option");
        let selected = [];
        let sliced = [];
        let list = [];

        for (let i = 0; i < arr.length; i++) {
            list.push({name: arr.item(i).textContent, id: arr.item(i).value});
        }

        const updateResult = (query) => {
            let resultList = document.getElementById("user_list");
            resultList.innerHTML = "";

            list.map((user) => {
                query.split(" ").map(function (word) {
                    if (user.name.toLowerCase().indexOf(word.toLowerCase()) !== -1) {
                        resultList.innerHTML += `<li class="redirect-form__option" onclick="addToSelected(${user.id})">${user.name}</li>`;
                    }
                })
            })
        }

        const addToSelected = (id) => {
            selected.push(id);
            const index = list.map(user => user.id).indexOf(id);
            sliced.push(list.splice(index, 1));

            document.querySelector(".input-selected").innerHTML = `<input type="hidden" value="${selected}" name="user_id"/>`;

            updateResult(document.querySelector(".user-input").value);

            document.querySelector(".selected-list").innerHTML = sliced.map((item) => {
                return item[0].name;
            });
        }


    </script>


    @error('user_id')
    <p>{{$message}}</p>
    @enderror

    <span class="input-selected">
        <input type="hidden" value="" name="user_id"/>
    </span>

    <button class="redirect-form__button" type="submit">Prześlij</button>

</form>
