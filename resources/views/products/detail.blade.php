@extends('layouts.app')

@section('title', 'Product Page')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/nouislider.css') }}" />
    <style>

        .wrapper-product{
            position:relative;
            top:55px;
        }

        .wrapper-header-comment{
            position:relative;
            top:75px;
        }

        .wrapper-comments{
            position:relative;
            top:95px;
        }
        .wrapper-reply{
            position:relative;
            margin-bottom:50px;
        }
        .wraps-product{
            position:relative;
        }
        .form-box{
            position:relative;
            width:800px;
            margin:0 auto;

        }
        .comment-box{
            top:15px;
            position:relative;
            width:1200px;
        }
    </style>
@endpush
@section('content')
<div class="data-wrapper">
    <div class="row justify-content-md-center wrapper-product">
        <div class="col-sm-3">
            <img src="{{$carArray["image"]}}" width="250" height="200"/>
        </div>
        <div class="col-sm-9">
            @if(Session::has('role') && Session::get('role') == "Administrator")
                <div class="row">
                    <a href="/editproduct/{{$carArray["carId"]}}"><button class="btn btn-info">Edit Product</button></a>
                </div>
            @endif
            <div class="row">
                <h2> {{$carArray["brand"]}}</h2>
            </div>
            <div class="row">
                Car Model   : {{$carArray['carModel']}}
            </div>
            <div class="row">
                Price       : Rp. {{number_format($carArray["price"],0)}}
            </div>
            <div class="row">
                Fuel        : {{$carArray["fuel"]}}
            </div>
            <div class="row">
                Year        : {{$carArray["yearBuilt"]}}
            </div>
            <div class="row">
                Engine Type : {{$carArray["engineType"]}}
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center wrapper-product">
        <div class="comment-box">
            <form>
                <div class="form-group">
                    <textarea class="form-control col-md-12" id="comments" v-model="comment" rows="3" placeholder="Add your Comments here"></textarea>
                </div>
                <input type="hidden" name="carid" id="carid" value="{{ $carArray["carId"] }}"/>
                <input type="hidden" name="userid" id="userid" value="{{ (Session::get('username')) ? Session::get('username') : "" }}"/>
                <button class="btn btn-info" type="button" v-on:click="addComment">Add Comment</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-md-center wrapper-header-comment">
        <h3>Comments</h3>
    </div>

    @foreach($carArray["commentData"] as $key => $value)
        <div class="row justify-content-md-center wrapper-comments">

            <div class="col-sm-2">
                <div class="row">
                    {{$value["username"]}}
                </div>
                <div class="row">
                    Voted : {{intval($value["voteCounter"])}}
                </div>
                <div class="row">
                    Upvote : {{intval($value["upvote"])}}
                </div>
                <div class="row">
                    Downvote : {{intval($value["downvote"])}}
                </div>
                <div class="row">
                    {{$value["Date"]}}
                </div>
                <div class="row">
                    <button class="btn btn-primary" v-on:click="upvote('{{$value["commentId"]}}')">Upvote</button>&nbsp;
                    <button class="btn btn-secondary" v-on:click="downvote('{{$value["commentId"]}}')">Downvote</button>
                </div>
            </div>
            <div class="col-sm-7">
                {{$value["comment"]}}
                <br/>

                   <!-- <div class="row justify-content-md-center wrapper-reply">
                        <div class="comment-box">
                            <form>
                                <div class="form-group">
                                    <textarea class="form-control col-md-12" id="comments" rows="3" placeholder="Add your Reply here"></textarea>
                                </div>
                                <button class="btn btn-info">Add Reply</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">Sugih Hartono</div>
                        <div class="col-sm-5">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet consequat diam. Phasellus venenatis at quam a cursus. Proin sed diam sed erat vulputate vestibulum. Aliquam erat volutpat. Vestibulum consectetur dignissim semper. Vestibulum ut nisi lobortis, ornare sapien eu, aliquam ipsum. Fusce ut accumsan urna. Nulla luctus nisl aliquam facilisis porta. Nulla nisi purus, euismod sit amet erat rutrum, porttitor bibendum neque. Maecenas egestas, eros vitae dictum convallis, quam elit gravida mauris, a eleifend nisl leo tristique felis. Sed pulvinar neque sit amet purus ultrices hendrerit. Curabitur sit amet pellentesque diam, nec hendrerit lacus. Vivamus eleifend massa et erat tempor, id accumsan risus commodo. Maecenas bibendum sodales eros, porttitor mollis arcu aliquet nec.
                            <br/>
                            <button class="btn btn-primary">Upvote</button>
                            <button class="btn btn-secondary">Downvote</button>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </div>-->
            </div>
            <div class="col-sm-3">
                <!--<button class="btn btn-default">Upvote</button>
                <button class="btn btn-default">Downvote</button>-->
                <!--<button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>-->
            </div>
        </div>
     @endforeach
</div>
@endsection

@push('scripts')

    <script>
        new Vue({
            el:'.data-wrapper',
            data:{
                comment:'',
                reply:'',
                carid:document.getElementById("carid").value,
                username:document.getElementById("userid").value
            },
            methods:{
                addComment:function(){

                    var data = {"comment":this.comment,"carId":this.carid,"username":this.username};

                    this.$http.post("/api/addcomments",data).then(response => {
                        if(response.data.http == "200"){
                            alert(response.data.Message);
                            location.reload();
                            return false;
                        }else{
                            alert(response.data.Message);
                        }
                    });
                },
                upvote:function(id){
                    if(this.username == null || this.username == ""){
                        alert("Please Login First.");
                        window.location.href = "/login";
                    }
                    var data = {"comment_id":id,"username":this.username};

                    this.$http.post("/api/upvotecomments",data).then(response => {
                        if(response.data.http == "200"){
                            alert(response.data.Message);
                            location.reload();
                            return false;
                        }else{
                            alert(response.data.Message);
                        }
                    });
                },
                downvote:function(id){
                    if(this.username == null || this.username == ""){
                        alert("Please Login First.");
                        window.location.href = "/login";
                    }
                    var data = {"comment_id":id,"username":this.username};

                    this.$http.post("/api/downvotecomments",data).then(response => {
                        if(response.data.http == "200"){
                            alert(response.data.Message);
                            location.reload();
                            return false;
                        }else{
                            alert(response.data.Message);
                        }
                    });
                }
            }
        })
    </script>
@endpush