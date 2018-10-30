<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bus Planner System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 40vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: center;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .from{
                position: absolute;
                left: 20px;
            }

            .to{
                position: absolute;
                left: 200px;
            }

            .departure{
                position: absolute;
                left: 400px;
            }

            .return{
                position: absolute;
                left: 600px;
            }

        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 top-right links">
            <ul class="nav navbar-nav">
                <li class="links"><a href="">Bus Planner System</a></li>
                <li class="links"><a href="{{ url('/') }}">Home</a></li>
                <li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown links">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"aria-expanded="false">Sign in <span class="caret"></span></a>
                    
                    <ul class="dropdown-menu">
                        <li class="links"><a href="{{ url('/') }}" >Login</a></li>
                        <li class="links"><a href="#">Register</a></li>
                    </ul>
                </li>

                <li class="links"><a href="{{ url('/contact') }}">Contact Us</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Welcome to BPS
                </div>

                <div class="links">
                    <a href="">Fast</a>
                    <a href="">Convenience</a>
                    <a href="">Affordable</a>
                    <a href="">Efficiency</a>
                    <a href="">Responsibility</a>
                    <a href="">Safety</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="page-header">
                    <h4>Bus Ticket</h4>
                </div>

                <form action="xxx.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="radio">
                                <label><input name="singleway" type="radio" id="singleway" value="One" required> One Way</label>
                                <label></label>
                                <label><input name="routeway" type="radio" id="routeway" value="Rpute"> Route Way</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="fromid" class="from">From</label>
                        <label for="toid" class="to">To</label>
                        <label for="departureid" class="departure">Departure Date</label>
                        <label for="returnid" class="return">Return Date</label>
                        <br>
                        <div>
                            <input name="fid" type="text" class="from" id="fromid" placeholder=" Kuala Lumpur" value="" required>
                            <input name="tid" type="text" class="to" id="toid" placeholder=" Penang" value="" required>
                            <input name="did" type="text" class="departure" id="departureid" placeholder=" Departure" value="" required>
                            <input name="rid" type="text" class="return" id="returnid" placeholder=" Return" value="" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">


            </div>
        </div>
    </body>
</html>
