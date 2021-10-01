<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title>Portal do Cientismo - Registar</title>
    <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Author Name Goes Here" />
    <meta name="design" content="Rafael Duarte" />
    <meta name="copyright" content="Copyright Goes Here" />
    <meta name="description" content="Description Goes Here" />
    <meta name="keywords" content="And, Finally, Keywords Go Here." />
    <!--Bootstrap Things-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
</head>

<header class="container-fluid bg-dark">
    <div class="jumbotron jumbotron-fluid text-left bg-dark text-white">
        <div class="container-fluid">
            <h1> <img src="images/portal2.png" class="img-fluid" style="width: 50px;"><b>Portal do Cientismo</b> </h1>
            <div class="container-fluid">
                <p>Onde os Cientistas podem ser quem dizem que são!</p>
            </div>
        </div>
    </div>
</header>



<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
        </ul>
        <span class="span1">
            <ul class="navbar-nav mr-auto">
                <!-- Meter o If aqui -->
                {if $logged_in}
                {else}
                <li class="nav-item">
                    <button class="btn btn-dark" type="button"><i class="fas fa-user-check"
                            style="margin: 2px"></i>Login</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-success" type="button" style="margin-left: 5px;"
                    onClick="window.location='../register.php'"><i class="fas fa-sign-in-alt"
                            style="margin: 2px"></i>Register</button>
                </li>
                {/if}
            </ul>
        </span>
    </div>
</nav>


<div class="w3-container">
    <div class="w3-red w3-center w3-card-4" style="text-align: center; background-color:#be060c; color:white;">
        <h3>{$Message}</h3>
    </div>
</div>

<body class="bg-secondary">
    <div class="container-sm">
        <form class="form-signin" action="register_action.php" method="POST">
            <h1><b>Register</b></h1>
            <div class="form-group">
                <label for="inputEmail1">Email address</label>
                <input type="email" class="form-control" id="inputEmail1" name="email" placeholder="Enter email" value="{$email}">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" name="first_name" placeholder="Enter your name" value="{$first_name}" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group ">
                        <label for="inputLastName">Last Name</label>
                        <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Enter your last name" value="{$last_name}">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="inputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password_digest" placeholder="Password" >
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirm" placeholder="Password" >
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                <label class="form-check-label" for="termsCheck">I've read and agreed with <a href="#"
                        style="color: black;">Terms of Service</a> </label>
            </div>
            <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
        </form>
    </div>

    <footer class="footer bg-dark">
        <div class="container">
            <p style="color: white;">© 2020 Copyright:<a href="#"> Rafael Duarte</a></p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>