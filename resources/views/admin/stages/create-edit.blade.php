@extends('layouts.admin')

@section('content')

@if (count($days) != 0)

<h1>{{$title}}</h1>

    @if ($errors->any())
        <div class="alert alert-danger w-25" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-form rounded-5">

            <div class="form">

                <form action="{{$route}}" method="POST" id="form">

                    @csrf
                    @method($method)

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_visited" name="is_visited" @if (old('is_visited', $stage?->is_visited)) checked @endif>
                        <label class="form-check-label" for="is_visited">Posto già visitato</label>
                    </div>

                    <div class="">
                        <label for="title">Titolo</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{old('title', $stage?->title)}}">
                        <p id="error-title"></p>
                    </div>

                    @if ($method == 'POST')

                    <div class="d-flex align-items-center gap-3 mt-4">

                        <div class="">

                            <select name="day_id" id="day_id" class="form-select" aria-label="Default select example">
                                <option selected>Scegli il giorno</option>

                                @foreach ($days as $day)
                                    <option value="{{$day->id}}">{{$day->date}}</option>
                                @endforeach

                            </select>

                            <p id="error-day-id"></p>

                        </div>

                        <div class="">
                            <input class="form-control" type="time" id="time" name="time">

                            <p id="error-time"></p>

                        </div>

                    </div>


                    @endif


                    <div class="">
                        <label for="place">Luogo</label>
                        <input class="form-control" type="text" id="place" name="place" value="{{old('place', $stage?->place)}}" onkeyup="getApiSearch()" autocomplete="off" list="countrydata">

                        <p id="error-place"></p>

                    </div>

                    <div class="autocomplete mb-2">
                        <ul id="autocompleteList" class="list-group brown"></ul>
                    </div>

                    @if ($method == 'PUT')

                        <div class="">
                            <label for="description">Descrizione</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$stage?->description}}</textarea>

                            <p id="error-description"></p>

                        </div>

                        <div class="mb-4">
                            <label for="rating">Voto</label>
                            <input class="form-control" type="number" name="rating" id="rating" min="0" max="5" value="{{old('rating', $stage?->rating)}}">

                            <p id="error-rating"></p>

                        </div>

                    @endif

                </form>

                <button type="submit" class="btn-submit btn" id="btn-form">Salva</button>

            </div>


        @else
            <div class="p-4">
                <div class="button">
                    <a class="fs-2 btn" href="{{route('admin.days.create')}}">Crea viaggio</a>
                </div>
            </div>

        @endif

    </div>

    <script>

        function getApiSearch() {
            const search = place.value.trim();

            if (search.length < 4) return;

            const apiKey = @json($_ENV['API_KEY_TOMTOM']);
            const apiUrl = 'https://api.tomtom.com/search/2/geocode/';

            axios.get(`${apiUrl}${encodeURIComponent(search)}.json?key=${apiKey}`, {headers: "application/json"})
                .then(response => {
                    console.log(response.data.results);
                    if (response.data.results.length > 0) {
                        const niceResults = response.data.results.map((result) => ({
                            address: {
                                freeformAddress: result.address.freeformAddress,
                            },
                            position: result.position
                        }));
                        updateAutocompleteList(niceResults);
                    }
                })
                .catch(error => {
                    console.error('Errore nella chiamata API di TomTom:', error);
                });

        }
        function updateAutocompleteList(results) {
            autocompleteList.innerHTML = '';

            results.forEach(result => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');

                listItem.addEventListener("mouseover", function() {
                    this.classList.add("active");
                });
                listItem.addEventListener("mouseout", function() {
                    this.classList.remove("active");
                });

                listItem.textContent = result.address.freeformAddress;

                listItem.addEventListener('click', function() {
                    place.value = result.address.freeformAddress;
                    autocompleteList.innerHTML = '';
                });

                autocompleteList.appendChild(listItem);
            });
        }

        const form = document.getElementById('form');
        const btn = document.getElementById('btn-form');

        const title = document.getElementById('title');
        const errorTitle = document.getElementById('error-title');

        const time = document.getElementById('time');
        const errorTime = document.getElementById('error-time');

        const place = document.getElementById('place');
        const errorPlace = document.getElementById('error-place');

        const rating = document.getElementById('rating');
        const errorRating = document.getElementById('error-rating');

        const dayId = document.getElementById('day_id');
        const errorDay = document.getElementById('error-day-id');

        const description = document.getElementById('description');
        const errorDescription = document.getElementById('error-description');

        let message;

        const method = @json($method);


        btn.addEventListener('click', function(){

            if(title.value.length == 0){
                message = 'Compilare campo';
                errorTitle.className = 'text-danger';
                errorTitle.innerHTML = message;
            }else if(title.value.length > 50){
                message = 'Massimo 50 caratteri';
                errorTitle.className = 'text-danger';
                errorTitle.innerHTML = message;
            }else{
                message = '';
                errorTitle.innerHTML = message;
            }

            if(place.value.length == 0){
                message = 'compilare campo';
                errorPlace.className = 'text-danger';
                errorPlace.innerHTML = message;
            }else{
                message = '';
                errorPlace.innerHTML = message;
            }

            if(method == 'POST'){

                if(dayId.value == 'Scegli il giorno'){
                    message = 'Compilare campo';
                    errorDay.className = 'text-danger';
                    errorDay.innerHTML = message;
                }else{
                    message = '';
                    errorDay.innerHTML = message;
                }

                if(time.value.length == 0){
                    message = 'compilare campo';
                    errorTime.className = 'text-danger';
                    errorTime.innerHTML = message;
                }else{
                    message = '';
                    errorTime.innerHTML = message;
                }

                if(
                    title.value.length != 0 &&
                    dayId.value != 'Scegli il giorno' &&
                    time.value.length != 0 &&
                    place.value.length != 0
                ){
                form.submit()
                }

            }

            if(method == 'PUT'){

                if(description.value.length >= 600){
                    message = 'Massimo 600 caratteri';
                    errorDescription.className = 'text-danger';
                    errorDescription.innerHTML = message;
                }else{
                    message = '';
                    errorDescription.innerHTML = message;
                }

                if(rating.value > 5){
                    message = 'Valore massimo di 5';
                    errorRating.className = 'text-danger';
                    errorRating.innerHTML = message;
                }else if(isNaN(parseInt(rating.value))){
                    message = 'Inserire un numero';
                    errorRating.className = 'text-danger';
                    errorRating.innerHTML = message;
                }else{
                    message = '';
                    errorRating.innerHTML = message;
                }

                console.log(title.value.length)

                if(
                title.value.length != 0 &&
                title.value.length <= 50 &&
                place.value.length != 0 &&
                description.value.length <= 600 &&
                rating.value <= 5 && ! isNaN(parseInt(rating.value))
                ){

                    form.submit()
                }
            }

        })

    </script>

@endsection


