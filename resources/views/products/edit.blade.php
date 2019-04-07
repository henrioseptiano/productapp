@extends('layouts.app')

@section('title', 'Product Page')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/nouislider.css') }}" />
    <style>

        .wrapper-product{
            position:relative;
            top:15px;
            display:flex;
            flex-wrap:wrap;
            justify-content: center;
        }
        .wraps-product{
            position:relative;
        }
        .form-box{
            position:relative;
            width:800px;
            margin:0 auto;

        }
    </style>
@endpush
@section('content')
    <div class="row wrapper-product">
        <div class="wraps-product">
            <div class="form-box">
                <form>
                    <div class="mb-3">
                        <label for="model">Car Id</label>
                        <input type="text" class="form-control" id="carmodel" disabled/>

                    </div>
                    <div class="mb-3">
                        <label for="model">Car Model</label>
                        <input type="text" class="form-control" id="carmodel" placeholder="Car Model"/>

                    </div>
                    <div class="form-group">
                        <label for="model">Car Brand</label>
                        <select class="custom-select">
                            <option value="">Select Brand</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Price"/>
                    </div>
                    <div class="mb-3">
                        <label for="fuel">Fuel</label>
                        <input type="text" class="form-control" id="fuel" placeholder="Fuel"/>
                    </div>
                    <div class="mb-3">
                        <label for="fuel">Transmission</label>
                        <input type="text" class="form-control" id="transmission" placeholder="Transmission"/>
                    </div>
                    <div class="mb-3">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" placeholder="Year"/>
                    </div>
                    <div class="mb-3">
                        <label for="year">Engine Type</label>
                        <input type="text" class="form-control" id="year" placeholder="Engine"/>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Save</button>

                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>

    </script>
@endpush