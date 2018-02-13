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

Flight::route('/admin/new_other', function(){
    Flight::render('admin/new_other');
});

Flight::route('/admin/game/@id', function($id){
    Flight::render('admin/view_game', array("id" => $id));
});

Flight::route('/admin/edit_game/@id', function($id){
    Flight::render('admin/edit_game', array("id" => $id));
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


    /* SERVICES */
/* CREATE A NEW GAME */
Flight::route('/admin/CreateGameService', function(){
    $gameService = new GameService();
    $result = $gameService->serviceCreateGame();
});

/* EDIT A GAME */
Flight::route('/admin/EditGameService/@id', function($id){
    $gameService = new GameService();
    $result = $gameService->serviceEditGame($id);
    Flight::redirect('/admin/game/'.$id);
});

/* DELETE A GAME */
Flight::route('/admin/DeleteGameService/@id', function($id){
    $gameService = new GameService();
    $result = $gameService->serviceDeleteGame($id);
    Flight::redirect('/admin/games');
});

/* CREATE A NEW OTHER */
Flight::route('/admin/CreateOtherService', function(){
    $otherService = new OtherService();
    $result = $otherService->serviceCreateOther();
});


Flight::start();
?>