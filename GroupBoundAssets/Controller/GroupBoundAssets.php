<?php

namespace Cockpit\Controller;

class GroupBoundAssets extends \Cockpit\Controller\Assets {

    public function index() {
        return $this->render('GroupBoundAssets:views/index.php');
    }

    public function listAssets() {
        $this->ensureFolder();
        return parent::listAssets();
    }

    public function upload() {
        $this->ensureFolder();
        return parent::upload();
    }

    public function addFolder() {
        $this->ensureFolder();
        return parent::addFolder();
    }

    private function ensureFolder() {
        $group = $this->user['group'];
        $currentFolder = $this->param('folder', '');

        if ($group === '') return; // TODO: Create a folder for this specific user? Is this even possible?
        if ($this->app->module('cockpit')->isSuperAdmin($group)) return;
        if ($currentFolder !== '') return;

        $folderData = ['_p' => $currentFolder, 'name' => sprintf('Group: %s', $group)];

        $folders = $this->app->storage
            ->find('cockpit/assets_folders', ['filter' => $folderData])
            ->toArray();

        if (!isset($folders[0])) {
            $result = $this->app->storage->save('cockpit/assets_folders', $folderData);
            $folders = $this->app->storage
                        ->find('cockpit/assets_folders', ['filter' => $folderData])
                        ->toArray();
        }

        $folderId = $folders[0]['_id'];

        if (!is_array($_REQUEST['filter'])) {
            $_REQUEST['filter'] = [];
        }

        $_REQUEST['folder'] = $folderId;
        $_REQUEST['filter']['folder'] = $folderId;
        $_REQUEST['parent'] = $folderId;
    }
}
