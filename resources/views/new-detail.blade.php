@extends('layout.app')
@section('content')
    <section class="lastest mt-2">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto text-center">
                    <div class="text">
                        <h4 class="heading">
                            {{$new->tieu_de}}
                        </h4>
                        <p> {{$new->mo_ta}}</p>
                        <p class="desc mb-2">{{($new->ngay_dang)}}</p>
                        {!! $new->noi_dung !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        p {
            font-size: 15px !important;
        }
    </style>
@endsection