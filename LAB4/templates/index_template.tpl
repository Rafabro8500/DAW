<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
    <title>Portal do Cientismo</title>
    <meta charset="UTF-8">
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

    <link rel="stylesheet" type="text/css" media="screen" href="../css/screen.css" />
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
                <a class="nav-link" href="index_template.html">Home <span class="sr-only">(current)</span></a>
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
                        href="register_template.html"><i class="fas fa-sign-in-alt"
                            style="margin: 2px"></i>Register</button>
                </li>
                {/if}
            </ul>
        </span>
    </div>
</nav>

<body class="bg-secondary">
    <div class="row">
        <!-- Secção dos Posts de Forums-->
        <div class="col-sm-8">
            <div class="container my-4" style="float: left;">
                <h1 style="color:whitesmoke;">Forums</h1>
                <div class="card">
                    <h5 class="card-header">Featured Posts</h5>
                    <div class="card-body">
                        <ul class="list-group">
                        {foreach item=post from=$posts}
                            <li class="media mb-4">
                                <img class="rounded-circle mr-3" src="images/bill_nye.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">{$post.name}</a></h5>
                                    <p>{$post.content}</p>
                                </div>
                            </li>
                        {/foreach}
                        </ul>
                        <a href="#" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>

            <div class="container my-4" style="float: left;">
                <div class="card">
                    <h5 class="card-header">Most Recent Posts</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="media mb-4">
                                <img class="rounded-circle mr-3" src="images/aliens.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">Giorgio A. Tsoukalos</a></h5>
                                    Guys, I swear to god I just saw an Alien!
                                </div>
                            </li>
                            <li class="media mb-4">
                                <img class="rounded-circle mr-3" src="images/turco.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><a href="#">Duarte Duarte</a></h5>
                                    Hey, can anyone identify this weird species for me? <a href="#">Picture</a>
                                </div>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" style="margin-top: 100px;">
            <div class="container">
                <div id="carousel1" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel1" data-slide-to="1"></li>
                        <li data-target="#carousel1" data-slide-to="2"></li>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/harold.jpg" alt="Harold">
                        </div>
                        <div class="carousel-item">
                            <img src="images/aliens.jpg" alt="Aliens Guy">
                        </div>
                        <div class="carousel-item">
                            <img src="images/bill_nye.jpg" alt="Bill Nye The Science Guy">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#carousel1" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim da secção dos posts-->




    <footer class="footer bg-dark">
        <div class="container-fluid-sm">
            <p style="color: white;">© 2020 Copyright:<a href="#"> Rafael Duarte</a></p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>