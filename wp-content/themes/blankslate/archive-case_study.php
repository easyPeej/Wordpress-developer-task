<?php get_header(); ?>

<main class="case-studies-archive">
    <header class="page-header">
        <h1><?php post_type_archive_title(); ?></h1>
    </header>

    <?php if (have_posts()) : ?>
        <div class="case-studies-block">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('case-study'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="case-study__thumb">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small'); ?></a>
                        </div>
                    <?php endif; ?>

                    <h3 class="case-study__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <div class="case-study__meta">
                        <?php echo esc_html(get_post_meta(get_the_ID(), 'client_name', true)); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php the_posts_pagination(); ?>

    <?php else : ?>
        <p>No case studies found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>