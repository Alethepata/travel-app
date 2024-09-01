@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>Tutte le foto</h1>

        @if(count($images) == 0)

            <div class="text-center">

                <h3>
                    Aggiungi foto
                </h3>

            </div>

        @else

            <div class="images-wrapper d-flex flex-wrap justify-content-center gap-3">

                @foreach ($images as $image)

                    <div class="image image_index position-relative">

                        <img src="{{asset('storage/'. $image->image)}}" class="d-block w-100" alt="...">

                        <div class="button position-absolute text-end p-2 ">
                            <form class="d-inline-block" action="{{ route('admin.images.destroy', $image->id) }}"
                            method="POST"
                            onsubmit="return confirm ('Sei sicuro di voler eliminare questa foto ?')"
                            >
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn-delete"><i class="fa-regular fa-circle-xmark"></i></button>
                            </form>
                        </div>

                    </div>

                @endforeach

            </div>

        @endif


    </div>


@endsection
