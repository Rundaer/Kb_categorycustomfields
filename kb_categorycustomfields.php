<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use Prestashop\Module\Kb_CategoryCustomFields\Install\InstallerFactory;

class Kb_Categorycustomfields extends Module
{
    public function __construct()
    {
        $this->name = 'kb_categorycustomfields';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Konrad Babiarz';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Category custom fields');
        $this->description = $this->l('Add custom fields to category page');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        if (!parent::install()) {
            return false;
        }

        $installer = InstallerFactory::create();

        return $installer->install($this);
    }

    public function uninstall()
    {
        $installer = InstallerFactory::create();

        return $installer->uninstall() && parent::uninstall();
    }
}
