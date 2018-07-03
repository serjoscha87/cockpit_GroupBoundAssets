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

$app->on('cockpit.assets.list', function(&$assets) {
   
    $accs = $this->storage->find('cockpit/accounts'); // get all accs

    $nuArray = [];
    foreach ($assets as $i => $asset) { // iterate all assets
        // determine the group of the user that uploaded the asset
        foreach ($accs as $i => $acc) {
            if ($acc['_id'] === $asset['_by']) // ... when found
                $asset['user_group'] = $acc['group']; // ... assign the found group name to the asset
        }

        // check if the current assets was created by someone with the same group as the logged in user; if so: put the current's iteration asset to a temp array
        if($asset['user_group'] === $this["user"]['group'] || $this->module('cockpit')->isSuperAdmin())
            $nuArray[] = $asset;
    }

    $assets->exchangeArray($nuArray); // exchange the list of assets with the processed list; this is necessary because using ->offsetUnset leaves the array like this: [0=>...,3=>...] and this will make cockpit think there are no entries

});
