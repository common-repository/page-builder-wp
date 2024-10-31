<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Post_Blog extends PBWP_Item_Loader
{

    protected $identity = 'blog';

    public function render()
    {

        $data = $this->data;

        $item_markup    = '';
        $post_type      = pbwp_get_item_options( $data, 'post_type', 'post' );
        $orderby        = pbwp_get_item_options( $data, 'orderby', 'ID' );
        $order          = pbwp_get_item_options( $data, 'order', 'DESC' );
        $total_posts    = pbwp_get_item_options( $data, 'total_posts', 6 );
        $blog_col       = pbwp_get_item_options( $data, 'columns', 3 );
        $posts_in       = pbwp_get_item_options( $data, 'posts_in' );
        $post_cats      = pbwp_get_item_options( $data, 'post_cats', '', true );
        $is_thumb       = pbwp_get_item_options( $data, 'is_thumb', 'yes' );
        $thumb_size     = pbwp_get_item_options( $data, 'thumb_size', 'medium' );
        $is_desc        = pbwp_get_item_options( $data, 'is_desc', 'yes' );
        $desc_length    = pbwp_get_item_options( $data, 'desc_length', 30 );
        $is_postmeta    = pbwp_get_item_options( $data, 'is_postmeta', 'yes' );
        $is_readmore    = pbwp_get_item_options( $data, 'is_readmore', 'yes' );
        $readmore_label = pbwp_get_item_options( $data, 'readmore_label', esc_html__( 'Read More...', 'page-builder-wp' ) );

        // Load masonry script
        wp_enqueue_script( 'jquery-masonry' );

        $item_markup .= '<div class="wpc_blog_post">';
        $item_markup .= '<div class="blog_post_cont masonry wpc_use_masonry">';
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
                $thumbnail  = get_the_post_thumbnail( $post_id, $thumb_size );

                $item_markup .= '<div class="wpc_blog_item wpc_col_'.esc_attr( $blog_col ).' wpc_masonry_item">';
                $item_markup .= '<div class="wpc_blog_item_inner">';

                if ( $is_thumb == 'yes' ) {
                    $item_markup .= '<div class="wpc_blog_thumb">'.$thumbnail.'</div>';
                }

                // End Blog Item Thumbnail
                $item_markup .= '<div class="wpc_blog_content">';
                $item_markup .= '<div class="wpc_blog_desc">';
                $item_markup .= ''.( $is_readmore != 'yes' ? '<a target="_blank" href="'.esc_url( get_permalink( $post_id ) ).'">' : '' ).'<h2 class="wpc_blog_title">'.$post_title.'</h2>'.( $is_readmore != 'yes' ? '</a>' : '' ).'';

                if ( $is_postmeta == 'yes' ) {
                    $item_markup .= '<span class="wpc_blog_meta"><span class="blog_meta_date">'.get_the_date().'</span> - <span class="blog_meta_author">'.esc_html__( 'By', 'page-builder-wp' ).' '.get_the_author().'</span></span>';
                }

                if ( $is_desc == 'yes' ) {

                    if ( $content != '' ) {
                        $item_markup .= '<div class="wpc_blog_excerpt">'.$content;

                        if ( $is_readmore == 'yes' ) {
                            $item_markup .= '<div class="wpc_blog_read_more_cont"><span class="wpc_blog_read_more"><a href="'.esc_url( get_permalink( $post_id ) ).'">'.esc_html( $readmore_label ).'</a></span></div>';
                        }

                        $item_markup .= '</div>'; // End post content
                    }

                }

                $item_markup .= '</div></div></div></div>'; // End Blog Desc > Blog Item Content > Blog Item Inner > Blog Item

            endwhile; // endwhile loop

            wp_reset_postdata();

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Error: '.esc_html__( 'No post found!', 'page-builder-wp' ).'</span>';

        }

        $item_markup .= '</div></div>'; // End blog_post_cont > End Blog Markup

        return $item_markup;

    }

}
