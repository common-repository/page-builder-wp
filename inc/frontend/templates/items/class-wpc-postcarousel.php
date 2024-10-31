<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Post_Carousel extends PBWP_Item_Loader
{

    protected $identity = 'postcarousel';

    public function render()
    {

        $data = $this->data;

        $item_markup    = '';
        $post_type      = pbwp_get_item_options( $data, 'post_type', 'post' );
        $orderby        = pbwp_get_item_options( $data, 'orderby', 'ID' );
        $order          = pbwp_get_item_options( $data, 'order', 'DESC' );
        $total_posts    = pbwp_get_item_options( $data, 'total_posts', 6 );
        $posts_in       = pbwp_get_item_options( $data, 'posts_in' );
        $post_cats      = pbwp_get_item_options( $data, 'post_cats', '', true );
        $posts_per_page = pbwp_get_item_options( $data, 'posts_per_page', 3 );
        $is_thumb       = pbwp_get_item_options( $data, 'is_thumb', 'yes' );
        $thumb_size     = pbwp_get_item_options( $data, 'thumb_size', 'medium' );
        $is_desc        = pbwp_get_item_options( $data, 'is_desc', 'yes' );
        $desc_length    = pbwp_get_item_options( $data, 'desc_length', 30 );
        $is_postmeta    = pbwp_get_item_options( $data, 'is_postmeta', 'yes' );
        $is_readmore    = pbwp_get_item_options( $data, 'is_readmore', 'yes' );
        $readmore_label = pbwp_get_item_options( $data, 'readmore_label', esc_html__( 'Read More...', 'page-builder-wp' ) );
        $delay          = pbwp_get_item_options( $data, 'delay', 3 );
        $autoplay       = pbwp_get_item_options( $data, 'autoplay', 'yes' );

        $pstcr_data_front = [
            'id'        => $data[ 'id' ],
            'per_slide' => $posts_per_page,
            'delay'     => $delay,
            'autoplay'  => $autoplay,
         ];

        wp_enqueue_style( 'owl-carousel' );
        wp_enqueue_style( 'owl-carousel-theme' );
        wp_enqueue_script( 'owl-carousel' );

        $item_markup .= '<div data-pstcr_data="'.esc_attr( htmlentities( serialize( $pstcr_data_front ) ) ).'" class="wpc_pstcr_post">';
        $item_markup .= '<div class="pstcr_post_cont">';
        $item_markup .= '<div class="owl-carousel owl-theme">';
        // Default args
        $query_args = [
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
         ];

        // Specific Post ID
        if ( '' != $posts_in ) {
            $query_args[ 'post__in' ] = explode( ',', $posts_in );
        }

        if ( is_numeric( $total_posts ) && $total_posts != 0 ) {
            $query_args[ 'posts_per_page' ] = $total_posts;
        } else {
            $query_args[ 'posts_per_page' ] = -1;
        }

        //Post Type
        $ptype     = [  ];
        $posttypes = explode( ',', $post_type );

        foreach ( $posttypes as $posttype ) {
            array_push( $ptype, $posttype );
        }

        $query_args[ 'post_type' ] = $ptype;

        // By Categories
        if ( '' != $post_cats ) {

            $categories = explode( ',', $post_cats );
            $gc         = [  ];

            foreach ( $categories as $grid_cat ) {
                array_push( $gc, $grid_cat );
            }

            $gc = implode( ',', $gc );

            $query_args[ 'category_name' ] = $gc;

            $taxonomies = get_taxonomies( '', 'object' );

            $query_args[ 'tax_query' ] = [ 'relation' => 'OR' ];

            foreach ( $taxonomies as $t ) {
                if ( in_array( $t->object_type[ 0 ], $ptype ) ) {
                    $query_args[ 'tax_query' ][  ] = [
                        'taxonomy' => $t->name,
                        'terms'    => $categories,
                        'field'    => 'slug',
                     ];
                }

            }

        }

        // Order
        $query_args[ 'orderby' ] = $orderby;
        $query_args[ 'order' ]   = $order;

        // Run Query
        $my_query = new WP_Query( $query_args );

        if ( $my_query->have_posts() ) {

            while ( $my_query->have_posts() ): $my_query->the_post();

                $post_title = the_title( '', '', false );
                $post_id    = $my_query->post->ID;
                $content    = wp_trim_words( get_the_content(), $desc_length );

                $item_markup .= '<div class="wpc_post_carousel_item">';
                $item_markup .= '<div class="wpc_post_carousel_item_inner">';

                if ( $is_thumb == 'yes' ) {
                    $item_markup .= '<div class="wpc_post_carousel_thumb">'.get_the_post_thumbnail( esc_html( $post_id ), esc_html( $thumb_size ) ).'</div>';
                }

                // End Post Carousel Item
                $item_markup .= '<div class="wpc_post_carousel_content">';
                $item_markup .= '<div class="wpc_post_carousel_desc">';
                $item_markup .= ''.( $is_readmore != 'yes' ? '<a target="_blank" href="'.esc_url( get_permalink( $post_id ) ).'">' : '' ).'<h2 class="wpc_post_carousel_title">'.esc_html( $post_title ).'</h2>'.( $is_readmore != 'yes' ? '</a>' : '' ).'';

                if ( $is_postmeta == 'yes' ) {
                    $item_markup .= '<span class="wpc_post_carousel_meta"><span class="pc_meta_date">'.get_the_date().'</span> - <span class="pc_meta_author">'.esc_html__( 'By', 'page-builder-wp' ).' '.get_the_author().'</span></span>';
                }

                if ( $is_desc == 'yes' ) {

                    if ( $content != '' ) {
                        $item_markup .= '<div class="wpc_post_carousel_excerpt">'.wp_kses_post( $content );

                        if ( $is_readmore == 'yes' ) {
                            $item_markup .= '<div class="wpc_post_carousel_read_more_cont"><span class="wpc_post_carousel_read_more"><a href="'.esc_url( get_permalink( $post_id ) ).'">'.esc_html( $readmore_label ).'</a></span></div>';
                        }

                        $item_markup .= '</div>'; // End post content
                    }

                }

                $item_markup .= '</div></div></div></div>'; // End Post Carousel Desc > Post Carousel Item Content > Carousel Item Inner > Carousel Item

            endwhile; // endwhile loop

            wp_reset_postdata();

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Error: '.esc_html__( 'No post found!', 'page-builder-wp' ).'</span>';

        }

        $item_markup .= '</div></div></div>'; // End owl-carousel > pstcr_post_cont > Post Carousel Markup

        return $item_markup;

    }

}
