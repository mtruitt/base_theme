<?php
get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-9">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page' );


                        endwhile; // End of the loop.
                        ?>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-3">
                        <?php
                        get_sidebar(); ?>
                    </div>
                </div><!-- .row -->
            </div><!-- .container -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
