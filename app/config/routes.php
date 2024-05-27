<?php
$router = new \Phalcon\Mvc\Router();

// Use $_SERVER['REQUEST_URI']
$router->setUriSource(
    \Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI
);

$router->add(
	'/articles/:action/', [
		'controller' => 'articles',
		'action'     =>'index',
		'category'   => 1,
	]
);
$router->add(
	'/articles/getNextPage/', [
		'controller' => 'articles',
		'action'     => 'getNextPage',
		'category'   => 1,
	]
);
$router->add(
	'/article/:action/', [
		'controller' => 'articles',
		'action'     =>'detail',
		'code'   => 1,
	]
);
$router->add(
	'/convert/', [
		'controller' => 'convert',
		'action'     =>'index',
		'code'   => 1,
	]
);
$router->handle();
return $router;

?>
