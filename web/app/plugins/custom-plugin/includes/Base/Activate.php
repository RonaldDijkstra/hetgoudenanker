<?php

/*
 * @package Custom_Plugin
 */

namespace Custom\Plugin\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}
