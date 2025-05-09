<?php

/*
 * @package Custom_Blocks
 */

namespace Custom\Blocks\Base;

class Activate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}
