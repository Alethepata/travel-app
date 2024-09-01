@extends('layouts.admin')

@section('content')
    <div class="container-d">

        @if (count($days) != 0)
            <div class="">
                <h1>Viaggio già creato</h1>
                <a href="{{route('admin.days.index')}}" class="btn">Mostra</a>
            </div>
        @else

        @if ($errors->any())
            <div class="alert alert-danger w-25" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
    @endif

            <form class="d-flex" action="{{route('admin.days.store')}}" method="POST" id="form">

                @csrf
                @method('POST')

                <div class="m-3">
                    <label for="start_date" class="form-label">Inizio</label>
                    <input class="form-control" type="date" name="start_date" id="start_date">

                    <p id="error-start-date"></p>

                </div>

                <div class="m-3">

                    <label for="ending_date"  class="form-label">Fine</label>
                    <input class="form-control" type="date" name="ending_date" id="ending_date">

                    <p id="error-ending-date"></p>

                </div>


            </form>

            <button type="submit" class="btn-submit btn" id="btn">Salva</button>

        @endif

    </div>

    <script>
        const form = document.getElementById('form');
        const btn = document.getElementById('btn');

        const startDate = document.getElementById('start_date');
        const errorStartDate = document.getElementById('error-start-date');

        const endingDate = document.getElementById('ending_date');
        const errorEndindDate = document.getElementById('error-ending-date');

        let message;

        btn.addEventListener('click', function(){
            if(startDate.value.length == 0){
                message = 'Compilare campo';
                errorStartDate.className = 'text-danger';
                errorStartDate.innerHTML = message;
            }else{
                message = '';
                errorStartDate.innerHTML = message;
            }

            if(endingDate.value.length == 0){
                message = 'Compilare campo';
                errorEndindDate.className = 'text-danger';
                errorEndindDate.innerHTML = message;
            }else{
                message = '';
                errorEndindDate.innerHTML = message;
            }

            if(startDate.value.length != 0 && endingDate.value.length != 0 ){
                form.submit()
            }

        })

    </script>


@endsection
