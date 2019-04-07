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
            /*border:1px solid grey;
            padding:35px;
            display:flex;
            flex-wrap:wrap;
            justify-content: center;*/
        }
        .wrapper-cards{
            width:100%;
            padding:35px;

        }
        .noUi-active .noUi-tooltip {
            display: block;
        }

        a{
            text-decoration: none;
            color:black;
        }

        a:hover{
            text-decoration: none;
            color:black;
        }
    </style>
@endpush
@section('content')
    <div class="row wrapper-product">
        <div class="wrapper-form">

                <form method="post" action="/search" class="form-box" role="search" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand" value="">
                        </div>
                        <div class="col-md-1 mb-1">

                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="model">Model</label>
                            <input type="text" name="model" class="form-control" id="model" placeholder="Model" value="">
                        </div>
                        <div class="col-md-1 mb-1">

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price">Price</label>
                            <div id="slider-handles"></div>
                            <div id="slider-value"></div>
                            <input type="hidden" name="value-min" id="value-min" value=""/>
                            <input type="hidden" name="value-max" id="value-max" value=""/>
                        </div>

                    </div>
                    <div class="form-row">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

            </div>
            <div class="wrapper-cards">
                @foreach($productData as $key => $value)
                    @if($key%3 == 0)
                    <div class="card-deck">
                    @endif
                        <div class="card">
                            <img src="{{$value["image"]}}" class="card-img-top" width="25" height="250" alt="...">
                            <a href="/detailproduct/{{$value["carId"]}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$value["brand"]}}</h5>
                                    <p class="card-text">{{$value["model"]}}</p>
                                    <p class="card-text">Rp.{{number_format($value["price"],0)}}</p>
                                </div>
                            </a>
                        </div>


                    @if($key != 0 && $key%3 == 0)
                      </div>
                    @endif
                @endforeach
             </div>
            <div class="row">
                {!! $productQuery->links() !!}
            </div>


        </div>

@endsection

@push('scripts')
    <script src="{{ URL::asset('js/nouislider.js') }}"></script>
    <script>
        var handlesSlider = document.getElementById('slider-handles');

        noUiSlider.create(handlesSlider, {
            start: [15000000, 800000000],
            connect:true,
            range: {
                'min': [10000000],
                'max': [1000000000]
            }
        });

        var sliderValue = document.getElementById('slider-value');

        handlesSlider.noUiSlider.on('update', function (values) {
            var formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            document.getElementById("value-min").value = values[0];
            document.getElementById("value-max").value = values[1];
            var value1 = formatter.format(values[0]);
            values[0] = value1;
            var value2 = formatter.format(values[1]);
            values[1] = value2;
            sliderValue.innerHTML = values.join(' - ');
        });
    </script>
@endpush