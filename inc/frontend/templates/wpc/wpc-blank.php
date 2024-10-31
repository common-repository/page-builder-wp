<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<!DOCTYPE html>
<html <?php language_attributes();?>>
<?php
wp_enqueue_style( 'wpc-templates', plugins_url( 'css/wp-composer-templates.css', __DIR__ ), [  ], PBWP_VERSION, 'all' );
?>
<head>
    <meta charset="<?php bloginfo( 'charset' );?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php do_action( 'pbwp_blank_template_header' ); ?>
</head>

<body <?php body_class();?>>
    <?php
while ( have_posts() ):
    the_post();
    ?>
    <div class="wpc-content--blank">
    <?php do_action( 'pbwp_blank_template_before_content' ); ?>
        <article id="post-<?php the_ID();?>" <?php post_class();?>>
            <div class="entry-content">
                <?php the_content();?>
            </div>
        </article>
    </div>
    <?php
endwhile;
do_action( 'pbwp_blank_template_footer' );
wp_footer();?>
</body>

</html>