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
                        <select v-model="car.brand" class="custom-select" id="carBrand">
                            <option value="">Select Brand</option>
                            {!! $brandItems !!}
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
                car:{
                    brand:document.getElementById("carBrand").val()
                },
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