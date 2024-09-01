@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger w-25" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-d">
            <form action="{{route('admin.notes.store', 'Stage=' . $stage_id)}}" method="POST" id="form">

                @csrf
                @method('POST')

                <div class="m-3">
                    <h4>Note</h4>
                    <textarea name="note" id="note" cols="30" rows="10"></textarea>

                    <p id="error"></p>

                </div>

            </form>

            <button type="submit" class="btn-submit btn" id="btn">Salva</button>

    </div>

    <script>

        const form = document.getElementById('form');
        const btn = document.getElementById('btn');

        const note = document.getElementById('note');
        const errorNote = document.getElementById('error');

        btn.addEventListener('click', function(){

            console.log('ciao');

            if(note.value.length == 0){
                message = 'Compilare il campo';
                errorNote.className = 'text-danger';
                errorNote.innerHTML = message;
            }else if(note.value.length > 255){
                message = 'Massimo 255 caratteri';
                errorNote.className = 'text-danger';
                errorNote.innerHTML = message;
            }else{
                message = '';
                errorNote.innerHTML = message;
            }

            if(note.value.length != 0 && note.value.length <= 255){
                form.submit()
            }
        })

    </script>


@endsection
