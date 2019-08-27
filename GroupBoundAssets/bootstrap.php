<?php
require_once(__DIR__ . '/Controller/GroupBoundAssets.php');

$app->path('GroupBoundAssets', 'addons/GroupBoundAssets/'); // shorten path

// rebind the route!
$app->bindClass('Cockpit\\Controller\\GroupBoundAssets', 'assetsmanager');

// load js
if( !empty($app['app.assets.base']) ){
    $app['app.assets.base'] = array_merge($app['app.assets.base'], [
        '/addons/GroupBoundAssets/assets/js/GroupBoundAssets.js'
    ]);
} else{
    $app['app.assets.base'] = ['/addons/GroupBoundAssets/assets/js/GroupBoundAssets.js'];
}
