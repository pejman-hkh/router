<?php
require_once __DIR__.'/../vendor/autoload.php';

use Pejman\Router as Router;

function getPath() {
	$appDir = str_replace( "webroot/index.php", "", $_SERVER['PHP_SELF'] );
	$reqUri = explode("?", $_SERVER['REQUEST_URI'])[0] ;
	return preg_replace( '#^'.$appDir.'#', "", $reqUri );
}

Router::setPath( getPath() );

Router::route('admin/{controller?}/{action?}/{id?}', function( $id = 0 ) {

	echo "in admin";

})->where( ['controller' => '[a-zA-Z]+', 'action' => '[a-zA-Z_]+', 'id' => '[a-zA-Z_0-9]+'] )->setExtension( [ 'html' ] )


->elseRoute('{controller?}/{action?}/{id?}', function() {

	echo "in user";

})->where( ['controller' => '[a-zA-Z]+', 'action' => '[a-zA-Z_]+', 'id' => '[a-zA-Z_0-9]+'] )->setExtension( [ 'html' ] )



->elseRoute( '{:all}', function( $p ) {
	echo "Another request";
});


Router::dispatch(function( $status ) {
	echo "\nstatus is ".$status;
});
?>