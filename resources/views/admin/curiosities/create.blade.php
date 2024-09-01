@extends('layouts.admin')

@section('content')
    <div class="container-d">

        @if ($errors->any())
            <div class="alert alert-danger w-25" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('admin.curiosities.store', 'Stage=' . $stage_id)}}" method="POST" id="form">
            @csrf
            @method('POST')

            <div class="m-3">
                <h4>Curiosità</h4>
                <textarea name="curiosity" id="curiosity" cols="30" rows="10"></textarea>
                <p id="error"></p>
            </div>

        </form>

        <button type="submit" class="btn-submit btn" id="btn">Salva</button>

    </div>

    <script>
        const form = document.getElementById('form');
        const btn = document.getElementById('btn');

        const curiosity = document.getElementById('curiosity');
        const errorNote = document.getElementById('error');

        btn.addEventListener('click', function(){

            console.log('ciao');

            if(curiosity.value.length == 0){
                message = 'Compilare il campo';
                errorNote.className = 'text-danger';
                errorNote.innerHTML = message;
            }else if(curiosity.value.length > 255){
                message = 'Massimo 255 caratteri';
                errorNote.className = 'text-danger';
                errorNote.innerHTML = message;
            }else{
                message = '';
                errorNote.innerHTML = message;
            }

            if(curiosity.value.length != 0 && curiosity.value.length <= 255){
                form.submit()
            }
        })
    </script>


@endsection
