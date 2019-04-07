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
                        <input type="text" class="form-control" id="carid" value="{{$car["carId"]}}" readonly/>

                    </div>
                    <div class="mb-3">
                        <label for="model">Car Model</label>
                        <input type="text" class="form-control" value="{{$car["carModel"]}}" id="carModel" placeholder="Car Model"/>

                    </div>
                    <div class="form-group">
                        <label for="model">Car Brand</label>
                        <select class="custom-select" id="carBrand">
                            <option value="">Select Brand</option>
                            {!! $brandItems !!}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" value="{{$car["price"]}}" placeholder="Price"/>
                    </div>
                    <div class="mb-3">
                        <label for="fuel">Fuel</label>
                        <input type="text" class="form-control" id="fuel" placeholder="Fuel" value="{{$car["fuel"]}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="transmission">Transmission</label>
                        <input type="text" class="form-control" id="transmission" value="{{$car["transmission"]}}" placeholder="Transmission"/>
                    </div>
                    <div class="mb-3">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" value="{{$car["yearBuilt"]}}" placeholder="Year"/>
                    </div>
                    <div class="mb-3">
                        <label for="engineType">Engine Type</label>
                        <input type="text" class="form-control" id="engineType" value="{{$car["engineType"]}}" placeholder="Engine"/>
                    </div>
                    <div class="mb-3">
                        <label>Image Preview</label>
                    </div>
                    <div class="mb-3">
                        <img src="{{$car["image"]}}" width="150" height="100"/>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="CustomFile" v-on:change="getInputValue">
                            <input type="hidden" id="hiddenFilename" value="{{$car["imageHide"]}}"/>
                            <label class="custom-file-label" for="CustomFile" id="filename">{{$car["image"]}}</label>
                        </div>
                    </div>

                    <button class="btn btn-success" type="button" v-on:click="editProduct">Save</button>

                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function(){
            $('#CustomFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                console.log(fileName);
                fileName = fileName.replace('C:\\fakepath\\'," ");
                //replace the "Choose a file" label
                $("#filename").html(fileName);
            });
        });
        new Vue({
            el:'.wrapper-product',
            data:{
                image:''
            },
            methods:{
                getInputValue:function($event){
                    this.image = $event.target.files[0];
                },
                editProduct:function(event){

                    var carId = document.getElementById("carid").value,
                        model = document.getElementById("carModel").value;

                    var form = document.querySelector('form');
                    var formData = new FormData(form);

                    formData.append('car_id',carId);
                    formData.append('model',model);
                    formData.append('brand_id',document.getElementById("carBrand").value);
                    formData.append('fuel',document.getElementById("fuel").value);
                    formData.append('price',document.getElementById("price").value);
                    formData.append('transmission',document.getElementById("transmission").value);
                    formData.append('year_built',document.getElementById("year").value);
                    formData.append('engine_type',document.getElementById("engineType").value);
                    if(this.image != ''){
                        formData.append('imageFile',this.image);
                    }else{
                        formData.append('image',document.getElementById("hiddenFilename").value);
                    }
                    formData.append('_method', 'PUT');
                    for (var key of formData.entries()) {
                        console.log(key[0] + ', ' + key[1]);
                    }

                    this.$http.post('/api/editcar', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',

                            }
                        }).then(response => {
                        if(response.data.http == "200"){
                            alert(response.data.Message);
                            window.location.href = "/product/";
                        }else{
                            alert(response.data.Message);
                        }
                    });
                }
            }
        });
    </script>
@endpush