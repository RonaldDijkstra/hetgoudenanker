<?php

/*
 * @package Custom_Fields
 */

namespace Custom\Fields\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}
