<?php

/*
 * @package Custom_Fields
 */

namespace Custom\Fields\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
