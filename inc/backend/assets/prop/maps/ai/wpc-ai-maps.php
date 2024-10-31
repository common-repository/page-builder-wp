<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_ai_maps()
{

    return [
        'ai_ready' => [
            'globalEDITOR'    => [
                'fields' => [
                    [
                        'selector'       => 'global_css',
                        'type'           => 'code',
                        'codeEditorMode' => true,
                        'codeLanguage'   => 'css',
                     ],
                 ],
             ],
            'rowEDITOR'       => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => '.self.|background-image',
                        'type'     => 'image',
                     ],
                    [
                        'selector'       => 'custom_css',
                        'type'           => 'code',
                        'codeEditorMode' => true,
                        'codeLanguage'   => 'css',
                     ],
                 ],
             ],
            'columnEDITOR'    => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => '.self. .wpc_column_inner|background-image',
                        'type'     => 'image',
                     ],
                    [
                        'selector'       => 'custom_css',
                        'type'           => 'code',
                        'codeEditorMode' => true,
                        'codeLanguage'   => 'css',
                     ],
                 ],
             ],
            'htmlRAW'         => [
                'fields' => [
                    [
                        'selector'       => 'code',
                        'type'           => 'code',
                        'codeEditorMode' => true,
                        'codeLanguage'   => 'html',
                     ],
                 ],
             ],
            'featureBox'      => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => '.ftre_box|background-image',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => 'title',
                        'type'     => 'title',
                     ],
                    [
                        'selector'       => 'featuredesc',
                        'type'           => 'description',
                        'textEditorMode' => true,
                     ],
                 ],
             ],
            'textEditor'      => [
                'fields' => [
                    [
                        'selector'       => 'text-editor',
                        'type'           => 'description',
                        'textEditorMode' => true,
                     ],
                 ],
             ],
            'typeCTA'         => [
                'fields'            => [
                    [
                        'selector' => 'title',
                        'type'     => 'title',
                     ],
                    [
                        'selector'       => 'desc',
                        'type'           => 'description',
                        'textEditorMode' => true,
                     ],
                    [
                        'selector' => '.wpc_item_typecta|background-image',
                        'type'     => 'image',
                     ],
                 ],
                'promptSuggestions' => [
                    'title'       => [ 'Craft a CTA title for', 'Generate a CTA title for', 'Generate an engaging CTA title for', 'Create an attention-grabbing CTA title for' ],
                    'description' => [ 'Generate an enticing CTA for', 'Craft a compelling CTA description for', 'Create a captivating CTA for a landing page', 'Generate a persuasive CTA description for' ],
                 ],
             ],
            'newsletterForm'  => [
                'fields'            => [
                    [
                        'selector' => 'title',
                        'type'     => 'title',
                     ],
                    [
                        'selector' => 'desc',
                        'type'     => 'description',
                     ],
                    [
                        'selector' => '.wpc_nf_body|background-image',
                        'type'     => 'image',
                     ],
                 ],
                'promptSuggestions' => [
                    'title'       => [ 'Craft an Intriguing Title for', 'Invent an Eye-Catching Title for', 'Craft the Perfect Newsletter Title for', 'Design a Thought-Provoking Title for' ],
                    'description' => [ 'Provide a compelling overview of', 'Create an intriguing newsletter blurb for', 'Craft a compelling newsletter description about' ],
                 ],
             ],
            'singleTitle'     => [
                'fields' => [
                    [
                        'selector' => 'title',
                        'type'     => 'title',
                     ],
                 ],
             ],
            'alertBox'        => [
                'fields' => [
                    [
                        'selector' => 'text',
                        'type'     => 'description',
                     ],
                 ],
             ],
            'productBox'      => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => 'title',
                        'type'     => 'title',
                     ],
                    [
                        'selector'       => 'productdesc',
                        'type'           => 'description',
                        'textEditorMode' => true,
                     ],
                    [
                        'selector' => '.prd_box|background-image',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'typeImage'       => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                    [
                        'selector' => '.self.|background-image',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'typeMaps'        => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'typeVideoPlayer' => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'pricingList'     => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'testimonial'     => [
                'fields' => [
                    [
                        'selector' => 'img_id',
                        'type'     => 'image',
                     ],
                 ],
             ],
            'contactForm'     => [
                'fields' => [
                    [
                        'selector' => '.wpc_form_main|background-image',
                        'type'     => 'image',
                     ],
                 ],
             ],
         ],
     ];

}
