<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

# Create reuasable fields in theme options

add_action( 'carbon_fields_register_fields', function() {
    Container::make( 'theme_options', __('Theme Options')) 
        ->add_fields( array(
            Field::make('text', 'crb_custom_tagline', 'Custom Tagline'),
            Field::make('image', 'crb_logo', 'Logo'),
        ));

    Container::make('post_meta', __( 'Extra Post Settings' ))
        ->where('post_type', '=', 'post')
        ->add_fields( array(
            Field::make('text', 'crb_subtitle', 'Subtitle'),
            Field::make('checkbox', 'crb_featured', 'Mark as Featured'),
        ));
});