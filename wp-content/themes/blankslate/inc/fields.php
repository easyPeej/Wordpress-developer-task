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



add_action('carbon_fields_register_fields', function () {
    Block::make(__('Latest Case Studies'))
        ->add_fields([
            Field::make('text', 'block_title', __('Block Title'))
                ->set_help_text('Optional heading above the case studies'),
            Field::make('text', 'posts_per_page', __('Number of Case Studies'))
                ->set_default_value(3),
        ])
        ->set_render_callback(function ($fields) {
            $title = esc_html($fields['block_title'] ?? '');
            $count = !empty($fields['posts_per_page']) ? intval($fields['posts_per_page']) : 3;

            $query = new WP_Query([
                'post_type'      => 'case_study',
                'posts_per_page' => $count,
            ]);

            if ($query->have_posts()) {
                echo '<div class="case-studies-block">';
                if ($title) {
                    echo '<h2 class="case-studies-block__title">' . $title . '</h2>';
                }
                while ($query->have_posts()) {
                    $query->the_post(); ?>
                <article class="case-study">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="case-study__thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>
                    <h3 class="case-study__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <?php if ($problem = carbon_get_post_meta(get_the_ID(), 'problem')) : ?>
                        <section class="case-study__section case-study__problem">
                            <h2>Problem Statement</h2>
                            <p><?php echo esc_html($problem); ?></p>
                        </section>
                    <?php endif; ?>
                    <div class="case-study__meta">
                        <span class="author"><?php the_author(); ?></span>
                        <span class="date"><?php echo get_the_date(); ?></span>
                    </div>
                </article>
<?php }
                echo '</div>';
                wp_reset_postdata();
            } else {
                echo '<p>No case studies found.</p>';
            }
        });
});
