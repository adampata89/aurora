<?php

use \Bramus\Router\Router;

$router = new Router();
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404 Page not found.';
});
$router->setNamespace('App\Controller');
$router->get('/', 'MainController@view');
$router->all('/login', 'UserController@login');
$router->all('/logout', 'UserController@logout');
$router->all('/register', 'UserController@register');
$router->all('/products', 'ProductController@view');
$router->all('/product-form', 'ProductController@productForm');
$router->post('/product-create', 'ProductController@productCreate');
$router->all('/product-modify', 'ProductController@productModify');
$router->all('/product-delete', 'ProductController@productDelete');
$router->get("/css/([A-Za-z0-9-_\.]+).css", function($filename){
    echo file_get_contents("src/view/css/".$filename.".css");
});
