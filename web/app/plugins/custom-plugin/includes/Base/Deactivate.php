<?php

/*
 * @package Custom_Plugin
 */

namespace Custom\Plugin\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
