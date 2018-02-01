<?php
header("Access-Control-Allow-Origin : *");

require "flight/Flight.php";
require "autoloader.php";

Flight::render('admin/header', array('header' => 'playingapp'), 'header');
Flight::render('admin/footer', array('footer' => 'playingapp'), 'footer');

Flight::route('/', function(){
    Flight::render('home');
});

Flight::route('/admin', function(){
    Flight::render('admin/admin');
});

Flight::route('/admin/games', function(){
    Flight::render('admin/games');
});

Flight::route('/admin/new_game', function(){
    Flight::render('admin/new_game');
});

Flight::route('/admin/users', function(){
    Flight::render('admin/users');
});

Flight::route('/admin/forum', function(){
    Flight::render('admin/forum');
});

Flight::route('/admin/statistics', function(){
    Flight::render('admin/statistics');
});

Flight::route('/admin/CreateGameService', function(){
    $gameService = new GameService();
    $result = $gameService->serviceCreateGame();
    // Flight::redirect('/admin/games');
});


Flight::start();
?>