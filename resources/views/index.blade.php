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
                background-image: url('../img/bg.jpg');
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
                color: #000000;
            }

            .links > a {
                color: #000000;
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

            body {font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box;}

            input[type=text],  select, textarea {
                width: 100%;
                height: 50%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=date]{
                width: 100%;
                height: 50%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                resize: vertical;
            }

            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            .container {
                border-radius: 5px;
                padding: 20px;
            }

            /* To create equal column */

            * {
                box-sizing: border-box;
            }

            /* Create four equal columns that floats next to each other */
            .column {
                float: left;
                width: 25%;
                padding: 10px;
                height: 110px; /* Should be removed. Only for demonstration */
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* For Bottom Navigation Bar */
            .navbar_bottom {
                overflow: hidden;
                background-color: #00FF00;
                bottom: 0;
                width: 100%;
            }

            .navbar_bottom a {
                float: left;
                display: block;
                color: #000000;
                text-align: center;
                padding: 5px 16px;
                text-decoration: none;
                font-size: 17px;
            }

            .navbar_bottom a:hover {
                background: #f1f1f1;
                color: black;
            }

            .navbar_bottom a.active {
                background-color: #4CAF50;
                color: white;
            }

        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 top-right links">
            <ul class="nav navbar-nav">
                <li class="links"><a href="/">Bus Planner System</a></li>
                <li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown links">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"aria-expanded="false">Sign in <span class="caret"></span></a>
                    
                    <ul class="dropdown-menu">
                        <li class="links"><a href="{{ url('/login') }}" >Login</a></li>
                        <li class="links"><a href="{{ url('/register') }}">Register</a></li>
                    </ul>
                </li>

                <li class="links"><a href="/contact">Contact Us</a></li>
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
            <div class="container">
                <div class="page-header">
                    <h4>Bus Ticket</h4>
                </div>

                <div class="form-group">
                    <form action="/action_page.php">
                        <label for="trip">Trip</label>
                        <div class="radio" id="select_route">
                            <label><input name="route" type="radio" id="sway" value="single" checked> One Way</label>
                            <label></label>
                            <label><input name="route" type="radio" id="rway" value="return"> Route Way</label>
                        </div>

                        <div class="column" style="background-color:#228B22;">
                            <label for="from">From</label>
                            <select id="from" name="from">
                                <option value="kl">Kuala Lumpur</option>
                                <option value="penang">Penang</option>
                                <option value="jb">Johor Bahru</option>
                            </select>
                        </div>

                        <div class="column" style="background-color:#228B22;">
                            <label for="to">To</label>
                            <select id="to" name="to">
                                <option value="kl">Kuala Lumpur</option>
                                <option value="penang">Penang</option>
                                <option value="jb">Johor Bahru</option>
                            </select>
                        </div>

                        <div class="column" style="background-color:#228B22;">
                            <label for="departure">Departure Date</label>
                            <input type="date" id="departure" name="departure" required>
                        </div>

                        <div class="column" style="background-color:#228B22;">
                            <label for="return">Return Date</label>
                            <input type="date" id="return" name="return" required="">
                        </div>
                        <!-- <input type="submit" value="Submit"> -->
                    </form>
                </div>
            </div>
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>Coming Soon</h1>

            </div>
        </div>
        
        <div class="navbar_bottom">
            <a href="{{ url('/') }}" class="active">Home</a>
            <a href="{{ url('/operator/login') }}">Operator Login</a>
            <a href="{{ url('/operator/registration') }}">Operator Register</a>
        </div>
    </body>
</html>
