<?php
header("Access-Control-Allow-Origin : *");

require "flight/Flight.php";
require "autoloader.php";

Flight::render('admin/header', array('header' => 'playingapp'), 'header');
Flight::render('admin/footer', array('footer' => 'playingapp'), 'footer');

    /* MAIN PAGES */
Flight::route('/', function(){
    Flight::render('home');
});

Flight::route('/admin', function(){
    Flight::render('admin/admin');
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


    /* GAMES */
Flight::route('/admin/games', function(){
    Flight::render('admin/games');
});

Flight::route('/admin/game/@id', function($id){
    Flight::render('admin/view_game', array("id" => $id));
});

Flight::route('/admin/new_game', function(){
    Flight::render('admin/new_game');
});

Flight::route('/admin/edit_game/@id', function($id){
    Flight::render('admin/edit_game', array("id" => $id));
});


    /* ATTRIBUTES */
Flight::route('/admin/attributes', function(){
    Flight::render('admin/attributes');
});

Flight::route('/admin/new_attribute', function(){
    Flight::render('admin/new_attribute');
});

Flight::route('/admin/developers', function(){
    Flight::render('admin/developers');
});

Flight::route('/admin/edit_developer/@id', function($id){
    Flight::render('admin/edit_developer', array("id" => $id));
});

Flight::route('/admin/publishers', function(){
    Flight::render('admin/publishers');
});

Flight::route('/admin/edit_publisher/@id', function($id){
    Flight::render('admin/edit_publisher', array("id" => $id));
});

Flight::route('/admin/franchises', function(){
    Flight::render('admin/franchises');
});

Flight::route('/admin/edit_franchise/@id', function($id){
    Flight::render('admin/edit_franchise', array("id" => $id));
});

Flight::route('/admin/systems', function(){
    Flight::render('admin/systems');
});

Flight::route('/admin/edit_system/@id', function($id){
    Flight::render('admin/edit_system', array("id" => $id));
});

Flight::route('/admin/labels', function(){
    Flight::render('admin/labels');
});

Flight::route('/admin/edit_label/@id', function($id){
    Flight::render('admin/edit_label', array("id" => $id));
});

Flight::route('/admin/themes', function(){
    Flight::render('admin/themes');
});

Flight::route('/admin/edit_theme/@id', function($id){
    Flight::render('admin/edit_theme', array("id" => $id));
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

/* CREATE A NEW ATTRIBUTE */
Flight::route('/admin/CreateAttributeService', function(){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceCreateAttribute();
});

/* EDIT A DEVELOPER */
Flight::route('/admin/EditDeveloperService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditDeveloper($id);
    Flight::redirect('/admin/developers');
});

/* DELETE A DEVELOPER */
Flight::route('/admin/DeleteDeveloperService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeleteDeveloper($id);
    Flight::redirect('/admin/developers');
});

/* EDIT A PUBLISHER */
Flight::route('/admin/EditPublisherService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditPublisher($id);
    Flight::redirect('/admin/publishers');
});

/* DELETE A PUBLISHER */
Flight::route('/admin/DeletePublisherService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeletePublisher($id);
    Flight::redirect('/admin/publishers');
});

/* EDIT A FRANCHISE */
Flight::route('/admin/EditFranchiseService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditFranchise($id);
    Flight::redirect('/admin/franchises');
});

/* DELETE A FRANCHISE */
Flight::route('/admin/DeleteFranchiseService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeleteFranchise($id);
    Flight::redirect('/admin/franchises');
});

/* EDIT A SYSTEM */
Flight::route('/admin/EditSystemService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditSystem($id);
    Flight::redirect('/admin/systems');
});

/* DELETE A SYSTEM */
Flight::route('/admin/DeleteSystemService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeleteSystem($id);
    Flight::redirect('/admin/systems');
});

/* EDIT A LABEL */
Flight::route('/admin/EditLabelService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditLabel($id);
    Flight::redirect('/admin/labels');
});

/* DELETE A LABEL */
Flight::route('/admin/DeleteLabelService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeleteLabel($id);
    Flight::redirect('/admin/labels');
});

/* EDIT A THEME */
Flight::route('/admin/EditThemeService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceEditTheme($id);
    Flight::redirect('/admin/themes');
});

/* DELETE A THEME */
Flight::route('/admin/DeleteThemeService/@id', function($id){
    $attributeService = new AttributeService();
    $result = $attributeService->serviceDeleteTheme($id);
    Flight::redirect('/admin/themes');
});


Flight::start();
?>