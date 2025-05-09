<?php

/*
 * @package Voys_CustomFields
 */

namespace Custom\Fields\Fields;

use Extended\ACF\Fields\Text;
use Extended\ACF\Location;

class BlockHero extends AbstractField
{
    public function register_acf_field_group(): void
    {
        if (!function_exists('register_extended_field_group')) return;

        register_extended_field_group([
            'title' => 'Block: Hero',
            'fields' => [
                Text::make('Title', 'title'),
            ],
            'style' => 'default',
            'location' => [
                Location::where('block', 'acf/hero')
            ],
        ]);
    }
}
