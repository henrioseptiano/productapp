@extends('layouts.app')

@section('title', 'Product Page')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/nouislider.css') }}" />
    <style>
        .wrapper{
            position:relative;
            top:50px;
        }
        .card-deck{
            margin:15px;
        }
        .wrapper-product{
            position:relative;
            top:15px;
        }
        .wrapper-form{
            width:100%;
            border:1px solid grey;
            padding:35px;
            display:flex;
            flex-wrap:wrap;
            justify-content: center;
        }
        .noUi-active .noUi-tooltip {
            display: block;
        }
    </style>
@endpush
@section('content')
    <div class="row wrapper-product">
        <div class="wrapper-form">

                <form class="form-box">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" placeholder="Brand" value="">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" placeholder="Model" value="">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="price">Price</label>
                            <div id="slider-handles"></div>
                        </div>

                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
                @foreach($productData as $key => $value)
                    @if($key%3 == 0)
                    <div class="card-deck">
                    @endif
                        <div class="card">
                            <img src="{{$value["image"]}}" class="card-img-top" width="25" height="250" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>


                    @if($key != 0 && $key%3 == 0)
                      </div>
                    @endif
                @endforeach

                {!! $productQuery->links() !!}

        </div>

@endsection

@push('scripts')
    <script src="{{ URL::asset('js/nouislider.js') }}"></script>
    <script>
        var handlesSlider = document.getElementById('slider-handles');

        noUiSlider.create(handlesSlider, {
            start: [15000000, 800000000],
            range: {
                'min': [10000000],
                'max': [1000000000]
            }
        });
    </script>
@endpush