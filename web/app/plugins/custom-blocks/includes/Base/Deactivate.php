<?php

/*
 * @package Custom_Blocks
 */

namespace Custom\Blocks\Base;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
