@extends('layouts.admin')

@section('content')

<div class="container h-75">
    <h1>Dashboard di {{Auth::user()->name}}</h1>

    <div class="background-dashboard w-100 h-100 mt-5">

        <div class="w-100 h-100 d-flex justify-content-center align-items-center gap-3">
            @foreach ($contents as $content)
            <div class="d-flex align-items-center gap-2 text-center">
                <div class="card card-dashboard rounded-3 py-3">

                    <h4>{{$content['title']}}</h4>

                    <div class="">
                        <p>{{$content['description']}}</p>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>

</div>
@endsection
