<?php

/*
 * @package Custom_Fields
 */

namespace Custom\Fields\Fields;

use Custom\Fields\ServiceInterface;

abstract class AbstractField implements ServiceInterface
{
    public function register() {
        add_action('acf/init', [$this, 'register_acf_field_group'], 11);
    }

    // public function register_acf_field_group(): void
    // {}
}
