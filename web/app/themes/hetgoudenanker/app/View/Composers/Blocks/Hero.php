<?php

namespace App\View\Composers\Blocks;

use Roots\Acorn\View\Composer;

class Hero extends Composer
{
    protected static $views = [
        'blocks.hero',
    ];

    public function with()
    {
        return [
            'title' => get_field('title'),
        ];
    }
}
