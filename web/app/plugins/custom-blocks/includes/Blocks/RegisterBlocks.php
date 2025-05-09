<?php

/**
 * Setup & Functions for Blocks
 */

namespace Custom\Blocks\Blocks;

use function Roots\view;

class RegisterBlocks
{
    /**
     * __construct
     * 
     * @return void
     */
    public function __construct()
    {
        // Check if ACF plugin is active!
        if (!class_exists('acf')) {
            return;
        }

        add_action('acf/init', [$this, 'registerBlockTypes'], 20);
        add_filter('allowed_block_types_all', [$this, 'allowedBlockTypes'], 10, 2);
        add_filter('post_type_filter', [$this, 'filterBlockTypesPages']);
        add_filter('block_categories_all', [$this, 'blockCategories'], 9, 2);
    }

    /**
     * Filter allowed block types based on post type.
     *
     * @param $allowedBlocks
     * @param WP_Block_Editor_Context $blockEditorContext
     * @return array
     */
    public function allowedBlockTypes($allowedBlocks, \WP_Block_Editor_Context $blockEditorContext): array
    {
        $allowedBlocks = [];

        if (!isset($blockEditorContext->post)) {
            return $allowedBlocks;
        }

        $post = $blockEditorContext->post;

        $contentBlocks = [
            'acf/hero'
        ];

        $singlePageBlocks = [
            'acf/calltoactionblock',
            'acf/calltoactioncard',
            'acf/quote',
            'acf/imagegallery',
            'core/shortcode',
            'core-embed/youtube',
            'core/embed',
            'core/list',
            'core/list-item',
            'core/heading',
            'core/paragraph',
            'core/freeform',
            'core/html',
            'core/image',
            'core/gallery',
        ];

        // Check post type and merge relevant blocks
        if (in_array($post->post_type, apply_filters('post_type_filter', []))) {
            $allowedBlocks = array_merge(
                $allowedBlocks,
                $contentBlocks,
            );
        }

        if (in_array($post->post_type, ['post'])) {
            $allowedBlocks = array_merge($allowedBlocks, $singlePageBlocks);
        }

        return $allowedBlocks;
    }

    /**
     * Register ACF block types.
     *
     * @return void
     */
    public function registerBlockTypes(): void
    {
        if (function_exists('acf_register_block_type')) {
            $blocks = $this->getBlockDefinitions();

            foreach ($blocks as $block) {
                if (!acf_get_block_type($block['name'])) {
                    acf_register_block_type($block);
                }
            }
        }
    }

    /**
     * Get the block definitions.
     *
     * @return array
     */
    public function getBlockDefinitions(): array
    {
        $blocks = [
            [
                'name' => 'hero',
                'title' => 'Hero',
                'category' => 'content',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><style>.a{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round}</style></defs><path class="a" d="M23.5 6.5a1 1 0 0 1-1 1h-15a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1zM20.5 12.5a1 1 0 0 1-1 1h-15a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1zM17.5 18.5a1 1 0 0 1-1 1h-15a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1z"/></svg>',
                'description' => 'A hero block with a background image, title and a button.',
                'render_callback' => function () {
                    echo view('blocks.hero');
                },
            ],
        ];

        usort($blocks, function ($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        return $blocks;
    }

    /**
     * Filter BlockTypesPages
     *
     * @return array
     */
    public function filterBlockTypesPages(): array
    {
        $allowedPostTypes[] = 'page';

        return $allowedPostTypes;
    }

    /**
     * Define the block categories.
     *
     * @param array $blockCategories
     * @param WP_Block_Editor_Context $blockEditorContext
     * @return array
     */
    public function blockCategories(array $blockCategories, \WP_Block_Editor_Context $blockEditorContext): array
    {
        if (empty($blockEditorContext->post)) {
            return $blockCategories;
        }

        return [
            [
                'slug'  => 'content',
                'title' => 'Content Blocks',
                'icon'  => null,
            ],
        ];
    }
}
