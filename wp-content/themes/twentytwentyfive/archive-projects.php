<?php get_header(); ?>

<div class="projects-archive">
    <h1>All Projects</h1>

    <?php if (have_posts()) : ?>
        <div class="projects-list">
            <?php while (have_posts()) : the_post(); ?>
                <div class="project-item">
                    <h2><?php the_title(); ?></h2>
                    <div class="project-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="project-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
                // Display pagination
                echo paginate_links();
            ?>
        </div>

    <?php else : ?>
        <p>No projects found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
