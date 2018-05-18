<?php

namespace Cockpit\Controller;

class GroupBoundAssets extends \Cockpit\Controller\Assets {

    public function index() {
        return $this->render('GroupBoundAssets:views/index.php');
    }

    public function listAssets() {

        $options = [
            'sort' => ['created' => -1]
        ];

        if ($filter = $this->param("filter", null)) $options["filter"] = $filter;
        if ($limit  = $this->param("limit", null))  $options["limit"] = $limit;
        if ($sort   = $this->param("sort", null))   $options["sort"] = $sort;
        if ($skip   = $this->param("skip", null))   $options["skip"] = $skip;

        $assets = $this->storage->find("cockpit/assets", $options);
        //$count  = (!$skip && !$limit) ? count($assets) : $this->storage->count("cockpit/assets", $filter);

        $this->app->trigger('cockpit.assets.list', [&$assets]);

        return ['assets' => $assets->toArray(), 'count'=>$assets->count()];
    }

}
