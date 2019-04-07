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
                <form id="addproduct-form">
                    <div class="mb-3">
                        <label for="model">Car Model</label>
                        <input type="text" v-model="car.model" class="form-control" id="carmodel" placeholder="Car Model"/>

                    </div>
                    <div class="form-group">
                        <label for="model">Car Brand</label>
                        <select v-model="car.brand" class="custom-select">
                            <option selected>Select car brand name</option>
                            {!! $brandItems !!}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="text" v-model="car.price" class="form-control" id="price" placeholder="Price"/>
                    </div>
                    <div class="mb-3">
                        <label for="fuel">Fuel</label>
                        <input type="text" v-model="car.fuel" class="form-control" id="fuel" placeholder="Fuel"/>
                    </div>
                    <div class="mb-3">
                        <label for="fuel">Transmission</label>
                        <input type="text" v-model="car.transmission" class="form-control" id="transmission" placeholder="Transmission"/>
                    </div>
                    <div class="mb-3">
                        <label for="year">Year</label>
                        <input type="text" v-model="car.year" class="form-control" id="year" placeholder="Year"/>
                    </div>
                    <div class="mb-3">
                        <label for="year">Engine Type</label>
                        <input type="text" v-model="car.enginetype" class="form-control" id="year" placeholder="Engine"/>
                    </div>
                    <!--v-model="image"-->
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="CustomFile" v-on:change="getInputValue">
                            <label class="custom-file-label" for="CustomFile">Choose file...</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" v-on:click="addProduct">Add Product</button>

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
                fileName = fileName.replace('C:\\fakepath\\'," ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
        });
         new Vue({
            el:'.wrapper-product',
            data:{
                car:{},
                image:''
            },
            methods:{
                getInputValue:function($event){
                    this.image = $event.target.files[0];

                },
                addProduct:function(event){
                    var formData = new FormData();
                    formData.append('image',this.image);
                    formData.append('model',this.car.model);
                    formData.append('brand_id',this.car.brand);
                    formData.append('fuel',this.car.fuel);
                    formData.append('price',this.car.price);
                    formData.append('transmission',this.car.transmission);
                    formData.append('year_built',this.car.year);
                    formData.append('engine_type',this.car.enginetype);
                    //this.car.image = formData;
                    //var datas = this.car;
                    // POST /someUrl
                    this.$http.post('/api/addcars', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
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