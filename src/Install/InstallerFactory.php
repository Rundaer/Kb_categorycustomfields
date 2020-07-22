<?php

declare(strict_types=1);

namespace Prestashop\Module\Kb_CategoryCustomFields\Install;

class InstallerFactory
{
    public static function create(): Installer
    {
        return new Installer();
    }
}
