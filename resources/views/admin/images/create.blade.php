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

    <div class="container-form rounded-5">

        <form action="{{route('admin.images.store', 'Stage='. $stage_id)}}" enctype="multipart/form-data" method="POST" id="form">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="images" class="form-label">Foto</label>
                <input class="form-control" type="file" id="images" name="images[]" multiple>
            </div>

            <p id="error"></p>

        </form>

        <button type="submit" class="btn-submit btn" id="btn">Salva</button>

    </div>

    <script>

        const form = document.getElementById('form');
        const btn = document.getElementById('btn');

        const images = document.getElementById('images');
        const errorImages = document.getElementById('error');

        btn.addEventListener('click', function(){

            console.log('ciao');

            if(images.value.length == 0){
                message = 'Compilare il campo';
                errorImages.className = 'text-danger';
                errorImages.innerHTML = message;
            }else{errorImages
                message = '';
                errorImages.innerHTML = message;
            }

            if(images.value.length != 0){
                form.submit()
            }
        })

    </script>


@endsection
