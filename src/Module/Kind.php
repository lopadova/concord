<?php
/**
 * Contains the Module Kind class.
 *
 * @copyright   Copyright (c) 2016 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2016-12-26
 *
 */


namespace Konekt\Concord\Module;


use Konekt\Enum\Enum;

class Kind extends Enum
{
    const __default = self::MODULE;

    const MODULE    = 'module';
    const BOX       = 'box';

    /** @var array  The texts for displaying items on UI */
    protected static $displayTexts = [
        self::MODULE => 'Module',
        self::BOX    => 'Box'
    ];

}