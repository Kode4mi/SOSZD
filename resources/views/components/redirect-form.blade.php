<form class="redirect-form" action="/redirect/{{$ticket->id}}" method="POST">

    @csrf
    @method("POST")

    <label>
        <input oninput="updateResult(this.value)"  type="text" placeholder="Szukaj Adresata">
    </label>

    <label class="label_adresat" for="user_select">Adresaci:</label>
    <ul class="redirect-form__select" multiple id="user_list">
        @foreach($users as $user)
            <li class="redirect-form__option" value="{{$user->id}}"> {{$user->first_name}} {{$user->last_name}} </li>
        @endforeach
    </ul>

    <script>

        let arr = document.getElementsByClassName("redirect-form__option");

        let list = [];

        for(let i=0; i< arr.length; i++) {
            list[i] = "";
            list[i] += arr.item(i).textContent;
        }

        console.log(list);

        function updateResult(query) {
            let resultList = document.getElementById("user_list");
            resultList.innerHTML = "";

            list.map(function(algo){
                query.split(" ").map(function (word){
                    if(algo.toLowerCase().indexOf(word.toLowerCase()) !== -1){
                        resultList.innerHTML += `<li class="redirect-form__option">${algo}</li>`;
                    }
                })
            })
        }

    </script>


    @error('user_id')
    <p>{{$message}}</p>
    @enderror

    <button class="redirect-form__button" type="submit">Prześlij</button>

</form>
