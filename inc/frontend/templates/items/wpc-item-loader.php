<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Item_Loader
{

    protected $data;
    protected $isBuilder;
    protected $itemIdentity;
    protected $custom_class;
    protected $use_clear_both;
    protected $custom_data_attr;

    public function __construct( $identity = '', $data = [  ], $isBuilder = false )
    {

        $this->data         = $data;
        $this->isBuilder    = $isBuilder;
        $this->itemIdentity = $identity;

    }

    public function render()
    {

        foreach ( $this->getChilds() as $child ) {

            $reflectionClass = new ReflectionClass( $child );
            $childData       = $reflectionClass->getDefaultProperties();

            if ( isset( $childData[ 'identity' ] ) && $childData[ 'identity' ] === $this->itemIdentity || isset( $childData[ 'identity' ] ) && is_array( $childData[ 'identity' ] ) && in_array( $this->itemIdentity, $childData[ 'identity' ] ) ) {

                if ( class_exists( $child ) ) {

                    $item       = new $child();
                    $item->data = $this->data;

                    if ( method_exists( $item, 'render' ) ) {

                        $markup = '';
                        $markup .= $this->markup_start();
                        $markup .= $item->render();
                        $markup .= $this->markup_end();

                        if ( isset( $this->use_clear_both ) && $this->custom_data_attr ) {
                            $markup .= '<div class="wpc_front_clear_both"></div>';
                        }

                        return $markup;

                    }

                }

                break;

            }

        }

    }

    private function getChilds()
    {

        $children = [  ];

        foreach ( get_declared_classes() as $class ) {

            if ( is_subclass_of( $class, __CLASS__ ) ) {
                $children[  ] = $class;
            }

        }

        return $children;

    }

    public function markup_start()
    {

        $classes    = $data_attr    = [  ];
        $id         = $this->data[ 'id' ];
        $type       = $this->data[ 'type' ];
        $is_child   = pbwp_is_tab_child( $this->data );
        $animate    = pbwp_animation_creator( $this->data );
        $item_class = pbwp_get_item_options( $this->data, 'itm_xtra_class' );
        $breakpoint = pbwp_visibility_breakpoint( $this->data );

        // Merge all available class
        $classes[  ] = $item_class;
        $classes[  ] = $breakpoint;
        $classes[  ] = is_customize_preview() && ! $this->isBuilder ? 'wpc_unmodified' : '';
        $classes[  ] = ( isset( $this->custom_class ) && $this->custom_class !== '' ? ' '.$this->custom_class : '' );
        $classes[  ] = ( is_customize_preview() && isset( $this->data[ 'disable' ] ) && $this->data[ 'disable' ] ? ' wpc_item_disabled' : '' );
        $classes[  ] = ( $animate ? $animate : '' );
        $classes[  ] = 'wpc_item_'.esc_attr( $id ).' wpc_item type_'.esc_attr( strtolower( $type ) );

        // Merge all custom data attribute
        if ( is_customize_preview() ) {
            $data_attr = array_merge( [
                'data-item-basename="'.esc_attr( $type ).'"',
                'data-item-icon-classname="item-type-'.esc_attr( strtolower( $type ) ).'"',
                'data-item-name="'.esc_attr( $this->data[ 'label' ] ).'"',
             ], $data_attr );
        }

        if ( isset( $this->custom_data_attr ) && $this->custom_data_attr !== '' ) {
            $data_attr[  ] = $this->custom_data_attr;
        }

        return '<div class="'.esc_attr( $this->merge_arguments( $classes, true ) ).'" data-wpc-type="item" id="'.esc_attr( $id ).'" '.$this->merge_arguments( $data_attr, true ).$is_child.'>';

    }

    public function markup_end()
    {

        if ( is_customize_preview() && isset( $this->data[ 'disable' ] ) && $this->data[ 'disable' ] ) {
            return '<div class="wpc_item_disabled_mark"><span title="'.esc_html__( 'This item is disabled', 'page-builder-wp' ).'" class="wpc_disabled_note"></span></div></div>';
        }

        return '</div>';

    }

    private function merge_arguments( $args, $space_first = false )
    {

        $all_args = '';

        if ( ! empty( $args ) ) {
            $args = array_map( 'trim', $args );
            $args = array_filter( $args );
            $args = array_values( array_unique( $args ) );

            if ( $space_first && isset( $all_args[ 0 ] ) ) {
                $args[ 0 ] = ' '.$args[ 0 ];
            }

            $all_args = implode( ' ', $args );

            return $all_args;
        }

        return $all_args;

    }

    /**
     * Cloning disabled
     */
    public function __clone()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

    /**
     * Serialization disabled
     */
    public function __sleep()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

    /**
     * De-serialization disabled
     */
    public function __wakeup()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

}
