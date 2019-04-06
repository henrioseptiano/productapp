<!DOCTYPE HTML>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <style>
        *{
            box-sizing:border-box;
        }
        .wrapper{
            position:relative;
        }
        #content{
            text-align:center;
        }
        .box-login{
            top:180px;
            width:400px;
            position:relative;
            padding:15px;
            margin:0 auto;
            border:2px solid dimgrey;
            border-spacing:15px 50px;
        }
    </style>
</head>
<body>

        <div class="wrapper">
            <div id="content">
                <div class="box-login">
                    <form>
                        <h3>Form Login</h3>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="username" placeholder="Username">
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form-control-sm" id="password" placeholder="Password">
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>


    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vue.min.js') }}"></script>
</body>
</html>