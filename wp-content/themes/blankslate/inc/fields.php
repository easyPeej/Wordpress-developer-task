<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

# Create reuasable fields in theme options

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', __('Theme Options'))
        ->add_fields(array(
            Field::make('text', 'crb_custom_tagline', 'Custom Tagline'),
            Field::make('image', 'crb_logo', 'Logo'),
        ));
});


# Custom block 
add_action('carbon_fields_register_fields', function () {
    Block::make(__('Custom Content Block'))
        ->add_fields([
            Field::make('text', 'block_text', __('Text')),
            Field::make('image', 'block_image', __('Image')),
            Field::make('text', 'block_comment', __('Comment')),
            Field::make('color', 'block_bg', __('Background Colour')),
        ])
        ->set_render_callback(function ($fields) {
            $text = esc_html($fields['block_text'] ?? '');
            $image = ! empty($fields['block_image']) ? wp_get_attachment_image($fields['block_image'], 'large') : '';
            $bg = $fields['block_bg'] ?? '#f5f5f5';
            $comment = esc_html($fields['block_comment'] ?? '');
?>

        <div class="custom-block" style="background-color: <?php echo esc_attr($bg); ?>;">
            <div class="custom-block__inner">
                <div class="custom-block__text"><?php echo $text; ?></div>
                <div class="custom-block__image"><?php echo $image; ?></div>

            </div>
        </div>
<?php
        });
});
