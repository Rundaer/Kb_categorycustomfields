<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use Prestashop\Module\Kb_CategoryCustomFields\Install\InstallerFactory;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;

class Kb_Categorycustomfields extends Module
{
    private $templates = [
        'hook' => 'module:kb_categorycustomfields/views/templates/hook/categorySeo.tpl'
    ];

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

    public function hookActionCategoryFormBuilderModifier(array $params)
    {
        //Retrieving the form builder
        /** @var FormBuilder $formBuilder */
        $formBuilder = $params['form_builder'];
 
        // https://devdocs.prestashop.com/1.7/development/components/form/types-reference/
        $formBuilder->add(
            'seo_text',
            TranslatableType::class,
            [
                'label' => $this->l('Seo Text'),
                'required' => false,
                'type' => TextareaType::class
            ]
        );

        // For more languages ??
        // $languages = Language::getLanguages(true);
        // foreach ($languages as $lang) {
        //     $params['data']['seo_text'][$lang['id_lang']] = 'Custom value for lang '.$lang['iso_code'];
        // }

        $category = new Category($params['id']);
        $params['data']['seo_text'] = $category->seo_text;

        //Remember to put this line to update the data in the form
        $formBuilder->setData($params['data']);
    }

    public function hookActionAfterCreateCategoryFormHandler(array $params)
    {
        $this->updateData($params['form_data'], $params);
    }

    public function hookActionAfterUpdateCategoryFormHandler(array $params)
    {
        $this->updateData($params['form_data'], $params);
    }

    protected function updateData(array $data, $params)
    {
        $cat = new Category((int)$params['id']);
        $cat->seo_text = $data['seo_text'];
        $cat->update();
    }

    public function hookDisplayWrapperBottom($params)
    {
        return $this->fetch($this->templates['hook'], $this->getCacheId($this->name));
    }
}
