<?php
/*
 * TODO
 * was wenn ein benutzer keine gruppe hat?
 * also wenn man das gruppen addon nicht benutzt und einen frischen user anlegt?
 * welche gruppe bekommt der dann wenn man das über cockpit direkt macht?
 */

require_once(__DIR__ . '/Controller/GroupBoundAssets.php');

$app->path('GroupBoundAssets', 'addons/GroupBoundAssets/'); // shorten path

// $app->bindClass('Cockpit\\Controller\\Assets', 'assetsmanager');
/*$app->bind('/groups', function() {
   return $this->invoke('Cockpit\\Controller\\Groups', 'groups');
});*/

// rebind the route!
$app->bindClass('Cockpit\\Controller\\GroupBoundAssets', 'assetsmanager');

// load js
$app['app.assets.base'] = array_merge($app['app.assets.base'], [
    '/addons/GroupBoundAssets/assets/js/GroupBoundAssets.js'
]);

$app->on('admin.init', function() {
    /*$this['app.assets.base'] = array_merge($app['app.assets.base'], [
        '/addons/GroupBoundAssets/assets/js/GroupBoundAssets.js'
    ]);*/
});

$app->on('cockpit.bootstrap', function() {

    /*$this['app.assets.base'] = array_merge($app['app.assets.base'], [
        '/addons/GroupBoundAssets/assets/js/GroupBoundAssets.js'
    ]);*/

    //$assets_path = $this->module('cockpit')->getGroupVar('assets.path', '/storage');

    /*$assets_path = '/storage';
    $s = COCKPIT_DIR.$assets_path;

    $this->path('#storage', $s);
    $this->path('#pstorage', $s);
    $this->path('#data', $s.'/data');
    $this->path('#cache', $s.'/cache');
    $this->path('#tmp', $s.'/tmp');
    $this->path('#thumbs', $s.'/thumbs');
    $this->path('#uploads', $s.'/uploads');
    */
}, 0);

/*
    [0] => __construct
    [1] => hasOne
    [2] => hasMany
    [3] => toArray
    [4] => __toString
    [5] => offsetExists
    [6] => offsetGet
    [7] => offsetSet
    [8] => offsetUnset
    [9] => append
    [10] => getArrayCopy
    [11] => count
    [12] => getFlags
    [13] => setFlags
    [14] => asort
    [15] => ksort
    [16] => uasort
    [17] => uksort
    [18] => natsort
    [19] => natcasesort
    [20] => unserialize
    [21] => serialize
    [22] => getIterator
    [23] => exchangeArray
    [24] => setIteratorClass
    [25] => getIteratorClass
 */

/*
USER: ($this['user'])
    [user] => admin
    [email] => admin@yourdomain.de
    [group] => admin
    [name] => Admin
    [active] => 1
    [i18n] => en
    [_created] => 1522338546
    [_modified] => 1522338546
    [_id] => 5abd0af32b78ddoc1804877517
 */

/*
 * TODO: -----COUNT is still wrong when stuff is filtered! -> done, now working
 */
$app->on('cockpit.assets.list', function(&$assets) {
    //die(print_r($this["user"],true));
    //die(print_r($this->module('cockpit')->isSuperAdmin(),true));
    //die(print_r($this["user"]['group'],true));

    //die(print_r(get_class_methods(get_class($assets)),true));
    //die(print_r($assets->toArray(),true));
    //$obj = ['assets' => [], 'count'=>0];
    //print_r($assets);
    /*$assets = array_filter($assets, function($a){
        return true;
    });*/

    //$groups = $this->module('cockpit')->getGroups();
    //die(print_r($groups,true));

    $accs = $this->storage->find('cockpit/accounts'); // get all accs
    //die(print_r($accs,true));

    //die(print_r($assets->offsetGet(1),true));
    $nuArray = [];
    foreach ($assets as $i => $asset) { // iterate all assets
        //$asset["description"] = 'TEST';
        /*if($this['user']['_id'] === ) {

        }*/

        // determine the group of the user that uploaded the asset
        foreach ($accs as $i => $acc) {
            if ($acc['_id'] === $asset['_by']) // ... when found
                $asset['user_group'] = $acc['group']; // ... assign the found group name to the asset
        }
        /*if (in_array($asset['_by'], array_column($accs, '_id'))) { // search value in the array
            // ...
        }*/

        // check if the current assets was created by someone with the same group as the logged in user; if so: put the current's iteration asset to a temp array
        if($asset['user_group'] === $this["user"]['group'] || $this->module('cockpit')->isSuperAdmin())
            $nuArray[] = $asset;
    }

    //$assets->offsetUnset(1);
    $assets->exchangeArray($nuArray); // exchange the list of assets with the processed list; this is necessary because using ->offsetUnset leaves the array like this: [0=>...,3=>...] and this will make cockpit think there are no entries

    /*foreach ($assets as $i => &$asset) {
        //$asset["description"] = 'TEST';
        if($i===0)
            unset ($asset);
    }*/
});