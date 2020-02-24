<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragonball Fighters</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fe11bb2046.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
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
        SimpleRouter::post('/delete/{id}', function(int $id) {require 'views/delete.php';})->name('delete');
        SimpleRouter::form('/edit/{id}', function(int $id) {require 'views/edit.php';})->name('edit');
        SimpleRouter::form('/new', function() {require 'views/new.php';})->name('new');
        SimpleRouter::post('/reset', function() {require 'views/reset.php';})->name('reset');

        //Combat
        SimpleRouter::post('/attack/{attacker}/{defender}', function(int $attackerId, int $defenderId) {require 'views/attack.php';})->name('attack');

        //Not found
        SimpleRouter::get('/not-found', function (){require 'views/error.php';});

        //Redirection si la route n'existe pas ou que la méthode n'est pas bonne
        SimpleRouter::error(function(Request $request, \Exception $exception) {
            if(($exception instanceof NotFoundHttpException && $exception->getCode() === 404) || ($exception instanceof NotFoundHttpException && $exception->getCode() === 403)) {
                response()->redirect('/not-found');
            }

        });
        
    
        SimpleRouter::start();
    
        ?>
        
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>