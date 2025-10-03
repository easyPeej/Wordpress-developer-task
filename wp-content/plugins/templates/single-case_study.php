<?php

/**
 * Single Case Study Template
 */
get_header(); ?>

<main class="case-study-single">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('case-study'); ?>>

            <h1 class="case-study__title"><?php the_title(); ?></h1>

            <?php if ($image_id = carbon_get_post_meta(get_the_ID(), 'image')) : ?>
                
                <div class="case-study__thumb">
                    <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                </div>
            <?php else: ?>
                <div class="case-study__thumb">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <?php endif ?>
            <div class="case-study__content">
                <?php the_content(); ?>
            </div>

            <div class="case-study__details">
                <?php if ($problem = carbon_get_post_meta(get_the_ID(), 'problem')) : ?>
                    <section class="case-study__section case-study__problem">
                        <h2>Problem</h2>
                        <p><?php echo esc_html($problem); ?></p>
                    </section>
                <?php endif; ?>

                <?php if ($background = carbon_get_post_meta(get_the_ID(), 'background')) : ?>
                    <section class="case-study__section case-study__background">
                        <h2>Background</h2>
                        <p><?php echo esc_html($background); ?></p>
                    </section>
                <?php endif; ?>

                <?php if ($methods = carbon_get_post_meta(get_the_ID(), 'methods')) : ?>
                    <section class="case-study__section case-study__methods">
                        <h2>Methods &amp; Data</h2>
                        <p><?php echo esc_html($methods); ?></p>
                    </section>
                <?php endif; ?>

                <?php if ($outcome = carbon_get_post_meta(get_the_ID(), 'outcome')) : ?>
                    <section class="case-study__section case-study__outcome">
                        <h2>Outcome</h2>
                        <p><?php echo esc_html($outcome); ?></p>
                    </section>
                <?php endif; ?>
            </div>

        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>






