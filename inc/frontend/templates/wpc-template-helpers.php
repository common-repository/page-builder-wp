<?php
/*
by WPExplorer
http://www.wpexplorer.com/wordpress-page-templates-plugin/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Page_Templater
{

    /**
     * A reference to an instance of this class.
     */
    private static $instance;

    /**
     * The array of templates that this plugin tracks.
     */
    protected $templates;

    /**
     * Returns an instance of this class.
     */
    public static function get_instance()
    {

        if ( null == self::$instance ) {
            self::$instance = new PBWP_Page_Templater();
        }

        return self::$instance;

    }

    /**
     * Initializes the plugin by setting filters and administration functions.
     */
    private function __construct()
    {

        $this->templates = [  ];

        // Add a filter to the attributes metabox to inject template into the cache.
        if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

            // 4.6 and older
            add_filter(
                'page_attributes_dropdown_pages_args',
                [ $this, 'register_project_templates' ]
            );

        } else {

            $sptPostType = pbwp_get_supported_post_types();

            // Add a filter to the wp 4.7 version attributes metabox
            foreach ( $sptPostType as $pstType ) {

                add_filter(
                    'theme_'.$pstType.'_templates', [ $this, 'add_new_template' ]
                );

            }

        }

        // Add a filter to the save post to inject out template into the page cache
        add_filter(
            'wp_insert_post_data',
            [ $this, 'register_project_templates' ]
        );

        // Add a filter to the template include to determine if the page has our
        // template assigned and return it's path
        add_filter(
            'template_include',
            [ $this, 'pbwp_view_project_template' ]
        );

        // Add your templates to this array.
        if ( pbwp_is_compatible_theme() ) {

            $this->templates = [
                'themes/'.pbwp_is_compatible_theme().'-full-width.php'      => 'WP Composer Full Width',
                'themes/'.pbwp_is_compatible_theme().'-full-width-auth.php' => 'WP Composer Full Width (Auth)',
             ];

        } else {

            $this->templates = [
                'wpc/wpc-full-width.php'      => 'WP Composer Full Width',
                'wpc/wpc-full-width-auth.php' => 'WP Composer Full Width (Auth)',
             ];

        }

        $this->templates[ 'wpc/wpc-blank.php' ] = 'WP Composer Blank';

    }

    /**
     * Adds our template to the page dropdown for v4.7+
     *
     */
    public function add_new_template( $posts_templates )
    {
        $posts_templates = array_merge( $posts_templates, $this->templates );

        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */
    public function register_project_templates( $atts )
    {

        // Create the key used for the themes cache
        $cache_key = 'page_templates-'.md5( get_theme_root().'/'.get_stylesheet() );

        // Retrieve the cache list.
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();

        if ( empty( $templates ) ) {
            $templates = [  ];
        }

        // New cache, therefore remove the old one
        wp_cache_delete( $cache_key, 'themes' );

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge( $templates, $this->templates );

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add( $cache_key, $templates, 'themes', 1800 );

        return $atts;

    }

    /**
     * Checks if the template is assigned to the page
     */
    public function pbwp_view_project_template( $template )
    {

        // Get global post
        global $post;

        // Return template if post is empty
        if ( ! $post ) {
            return $template;
        }

        $template_name = get_post_meta(
            $post->ID, '_wp_page_template', true
        );

        /* Backwards compatibility after move this file to templates root folder and move all templates to folder based on template mode */
        if ( $template_name === 'zoom-lite-full-width.php' || $template_name === 'zoom-lite-full-width-auth.php' ) {
            $template_name = 'themes/'.$template_name;
            /* Update _wp_page_template meta */
            update_post_meta( $post->ID, '_wp_page_template', sanitize_text_field( $template_name ) );
        }

        // Return default template if we don't have a custom one defined
        if ( ! isset( $this->templates[ $template_name ] ) ) {
            return $template;
        }

        $file = plugin_dir_path( __FILE__ ).$template_name;

        // Just to be safe, we check if the file exist first
        if ( file_exists( $file ) ) {
            return esc_html( $file );
        } else {
            echo esc_html( $file );
        }

        // Return template

        return $template;

    }

}
