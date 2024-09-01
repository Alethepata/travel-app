<?php

function getDateFormat($date){
    $new_date = date_create($date);
    return date_format($new_date, "d/m/Y");
}

?>

@extends('layouts.admin')

@section('content')

<div class="container h-100 overflow-x-auto d-flex gap-4 pb-4">

    @if (count($days) == 0)

        <div class="px-2">
            <div class="button text-center">
                <a class="fs-2 btn" href="{{route('admin.days.create')}}">Crea viaggio</a>
            </div>
        </div>

    @else

        @foreach ($days as $day )

            <div class="row_custom">

                <div class="col_custom h-100">

                    <div class="days text-center rounded-3">
                        <div class="d-flex justify-content-between px-3">

                            @if ($day->title == 'Giorno 0')

                                <span>Primo giorno</span>

                            @else

                                <span>{{$day->title}}</span>

                            @endif

                            <div class="button">
                                <form class="d-inline-block" action="{{ route('admin.days.destroy', $day) }}"
                                method="POST"
                                onsubmit="return confirm ('Sei sicuro di voler eliminare ?')"
                                >
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn-delete text-light"><i class="fa-regular fa-circle-xmark"></i></button>
                                </form>
                            </div>

                        </div>
                        <h3>{{getDateFormat($day->date)}}</h3>

                    </div>

                    <div class="toast_wrapper p-2 rounded-3">

                        @foreach ($stages as $stage )

                            @if ($stage->day_id == $day->id)

                            <a href="{{route('admin.stages.show', $stage)}}">

                                <div class="toast_custom mb-3 rounded-2 shadow" role="alert" aria-live="assertive" aria-atomic="true">

                                    <div class="toast-header border-bottom pb-2">

                                        <strong class="me-auto">{{$stage->title}}</strong>

                                        <small>{{substr($stage->date, 11, 5)}}</small>

                                        <div class="button ms-2 text-end pe-1 ">

                                            <form class="d-inline-block" action="{{ route('admin.stages.destroy', $stage) }}"
                                            method="POST"
                                            onsubmit="return confirm ('Sei sicuro di voler eliminare la tappa {{$stage->title}} ?')"
                                            >
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn-delete"><i class="fa-regular fa-circle-xmark"></i></button>
                                            </form>

                                        </div>

                                    </div>

                                    <div class="toast-body pt-2 d-flex justify-content-around align-items-center">

                                        <div class="">
                                            <i class="fa-solid fa-map-pin"></i>
                                            <span>{{$stage->place}}</span>
                                        </div>

                                        @if ($stage->is_visited)

                                            <div class="">
                                                <i class="fa-solid fa-check"></i>
                                                <span>Visitato</span>
                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </a>


                            @endif

                        @endforeach

                        <div class="button text-center mb-1">
                            <a class="fs-2 text-light" href="{{route('admin.stages.create')}}"><i class="fa-regular fa-square-plus"></i></a>
                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    @endif
</div>


@endsection
