<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Plugin Name: Case Studies
 * Description: Registers a Case Studies custom post type and shortcode.
 * Version: 1.0
 * Author: PJ
 */

if (! defined('ABSPATH')) exit;

add_action('init', function () {
    register_post_type('case_study', [
        'labels' => [
            'name'          => __('Case Studies'),
            'singular_name' => __('Case Study'),
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest' => true,
    ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Case Study Details'))
        ->where('post_type', '=', 'case_study')
        ->add_fields([
            Field::make('text', 'problem', __('Case Study Problem')),
            Field::make('text', 'background', __('Background')),
            Field::make('text', 'methods', __('Methods & Data')),
            Field::make('text', 'outcome', __('Outcome')),
            Field::make('image', 'image', __('Image')),
        ]);
});


// shortcode [latest_case_studies]
add_shortcode('latest_case_studies', function ($atts) {
    $query = new WP_Query([
        'post_type'      => 'case_study',
        'posts_per_page' => 3,
    ]);

    ob_start();
    if ($query->have_posts()) {
        echo '<div class="case-studies">';
        while ($query->have_posts()) {
            $query->the_post();
?>
            <article class="case-study">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="case-study__thumb">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    </div>
                <?php endif; ?>
                <h3 class="case-study__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                    <div class="case-study__meta">
                        <span class="author"><?php the_author(); ?></span>
                        <span class="date"><?php echo get_the_date(); ?></span>
                    </div>
            </article>
<?php
        }
        echo '</div>';
        wp_reset_postdata();
    }
    return ob_get_clean();
});

// load single template
add_filter('single_template', function ($template) {
    if (is_singular('case_study')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/single-case_study.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
});
