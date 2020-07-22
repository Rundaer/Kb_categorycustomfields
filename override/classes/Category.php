<?php

class Category extends CategoryCore
{
    public $seo_text;

    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, \Context $context = null)
    {
        //Définition des nouveaux champs

        self::$definition['fields']['seo_text'] = [
            'type' => self::TYPE_HTML,
            'lang' => true,
            'required' => false,
            'validate' => 'isCleanHtml'
        ];

        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }
}
