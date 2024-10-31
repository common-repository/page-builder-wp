<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Row_Inner extends PBWP_Item_Loader
{

    protected $identity = 'rowinner';

    public function render()
    {

        $data = $this->data;

        $postID = ( isset( $data[ 'postID' ] ) ? $data[ 'postID' ] : get_the_ID() );

        $builder  = pbwp_get_global_options( $postID, 'builder' );
        $id       = $data[ 'id' ];
        $innerRow = [  ];

        foreach ( $builder as $row ) {

            if ( $row[ 'inner_of' ] == $id ) {
                $innerRow[ 'builder' ] = $row;
                break;
            }

        }

        return pbwp_generate_rows( $innerRow, false, true );

    }

}
