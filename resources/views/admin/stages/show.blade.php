<?php

function getDateFormat($date){
    $new_date = date_create($date);
    return date_format($new_date, "d/m/Y");
}

?>

@extends('layouts.admin')

@section('content')

    <div class="container">


        <div class="header_text d-flex justify-content-between align-items-center gap-5">

            <div class="d-flex align-items-center gap-3">

                <h1>
                    {{$stage->title}}
                </h1>

                <a href="{{route('admin.stages.edit', $stage)}}"><i class="fa-regular fa-pen-to-square fs-3"></i></a>

            </div>

            <div class="">

                <div class="place">

                    <i class="fa-solid fa-map-pin"></i>
                    <span>{{$stage->place}}</span>

                </div>

                <div class="date">

                    <span>
                        {{getDateFormat($stage->date)}}
                    </span>

                    <span>
                        {{substr($stage->date, 11, 5)}}
                    </span>

                </div>

            </div>


        </div>


        <div class="images text-center my-4">
            <div class="text d-flex just align-items-center gap-3">
                <h3>Foto</h3>
                <a class="fs-2" href="{{route('admin.images.create', 'Stage='. $stage->id)}}"><i class="fa-regular fa-square-plus"></i></a>
                <a class="fs-2" href="{{route('admin.images.index', 'Stage='. $stage->id)}}"><i class="fa-regular fa-eye"></i></a>
            </div>

            @if (count($stage->images) != 0)

            <div id="carouselExample" class="carousel d-flex justify-content-center slide carousel-fade">

                <div class="carousel-inner">

                    <div class="carousel-item active position-relative">
                      <img src="{{asset('storage/'. $stage->images[0]->image)}}" class="d-block w-100" alt="...">
                    </div>

                    @for ($i = 1; $i < count($stage->images); $i++)

                        <div class="carousel-item">
                          <img src="{{asset('storage/'. $stage->images[$i]->image)}}" class="d-block w-100" alt="...">
                        </div>

                    @endfor

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>

                </div>

            </div>


            @else

                <img src="{{asset('image/assets/Placeholder.png')}}" alt="">

            @endif

        </div>

        <div class="rating text-center fs-4">

            @if ($rating)

                @for ($i = 0; $i < $rating; $i++)
                    <span>
                        <i class="fa-solid fa-star"></i>
                    </span>
                @endfor

                @for ($i = 0; $i < $rating_different; $i++)
                    <span>
                        <i class="fa-regular fa-star"></i>
                    </span>
                @endfor

            @else

                <a href="{{route('admin.stages.edit', $stage)}}">

                    @for ($i = 0; $i < 5; $i++)
                        <span>
                            <i class="fa-regular fa-star"></i>
                        </span>
                    @endfor

                </a>

            @endif

        </div>


        <div class="main_text my-4">

            <div class="description">

                <div class="box_description rounded-5 p-4 d-flex flex-column justify-content-center align-items-center">
                    @if ($stage->description)

                        <div class="text h-100 overflow-y-auto">
                            <p>
                                {{$stage->description}}
                            </p>

                        </div>

                    @else
                        <h5>
                            Aggiungi descrizione
                        </h5>
                        <a class="fs-2" href="{{route('admin.stages.edit', $stage)}}"><i class="fa-regular fa-square-plus"></i></a>
                    @endif
                </div>

            </div>

            <div class="notes_wrapper d-flex flex-wrap gap-5 my-4">


                @if ($stage->notes)

                    @foreach ($stage->notes as $note)

                        <div class="note shadow rounded-bottom-3">

                            <div class="button ms-2 text-end pe-1 ">

                                <form class="d-inline-block" action="{{ route('admin.notes.destroy', $note) }}"
                                method="POST"
                                onsubmit="return confirm ('Sei sicuro di voler eliminare la nota ?')"
                                >
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn-delete"><i class="fa-regular fa-circle-xmark"></i></button>
                                </form>

                            </div>

                            <div class="h-75 overflow-y-auto">
                                <p>
                                    {{$note->note}}
                                </p>
                            </div>


                        </div>

                    @endforeach

                @endif

                <a href="{{route('admin.notes.create', 'Stage=' . $stage->id)}}">

                    <div class="add_note text-center">
                        <span>Aggiungi nota</span>
                    </div>

                </a>

            </div>

            <div class="curiosity my-4">

                <div class=" d-flex align-items-center gap-3 mb-2">

                    <h3>
                        Curiosità
                    </h3>

                    <a class="fs-4" href="{{route('admin.curiosities.create', 'Stage='. $stage->id)}}"><i class="fa-regular fa-square-plus"></i></a>

                </div>

                @if ($stage->curiosities)

                    <div class="d-flex gap-3 justify-content-center flex-wrap">

                        @foreach ($stage->curiosities as $curiosity)
                            <div class="curiosity_card rounded-3 p-3">

                                <div class="button ms-2 text-end pe-1 ">

                                    <form class="d-inline-block" action="{{ route('admin.curiosities.destroy', $curiosity) }}"
                                    method="POST"
                                    onsubmit="return confirm ('Sei sicuro di voler eliminare questa curiosità ?')"
                                    >
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn-delete text-light"><i class="fa-regular fa-circle-xmark"></i></button>
                                    </form>

                                </div>

                                <div class="h-75 overflow-y-auto">
                                    <p>
                                        {{$curiosity->curiosity}}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>

                @else



                @endif

            </div>

        </div>

        {{-- <div class="maps">
            <h1>Mappa</h1>
            <div id="map" class="map w-100 h-100"></div>

        </div> --}}

    </div>

@endsection

