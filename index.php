<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragonball Fighters</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fe11bb2046.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background: #F85B1A">
        <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="" width=30></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/battleground">Champ de bataille</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Gérer les personnages
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/all">Afficher la liste</a>
                        <a class="dropdown-item" href="/new">Créer un personnage</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container my-4">
        <?php
        require 'vendor/autoload.php';
    
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    
        use Pecee\Http\Request;
        use Pecee\SimpleRouter\SimpleRouter;
        use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
        // https://packagist.org/packages/pecee/simple-router
    
        require 'vendor/pecee/simple-router/helpers.php';
    
        SimpleRouter::get('/', function() {require 'views/home.php';})->name('home');
        SimpleRouter::get('/battleground', function() {require 'views/battleground.php';})->name('battleground');

        // Administration des personnages
        SimpleRouter::get('/all', function() {require 'views/all.php';})->name('all');
        SimpleRouter::post('/delete/{id}', function($id) {require 'views/delete.php';})->name('delete');
        SimpleRouter::form('/edit/{id}', function($id) {require 'views/edit.php';})->name('edit');
        SimpleRouter::form('/new', function() {require 'views/new.php';})->name('new');

        SimpleRouter::get('/not-found', function (){require 'views/error.php';});

        SimpleRouter::error(function(Request $request, \Exception $exception) {
            if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
                response()->redirect('/not-found');
            }

        });
        
    
        SimpleRouter::start();
    
        ?>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>