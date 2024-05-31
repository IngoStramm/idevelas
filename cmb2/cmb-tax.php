<?php

add_action('cmb2_admin_init', 'iv_register_taxonomy_metabox');
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function iv_register_taxonomy_metabox()
{

    /**
     * Metabox to add fields to categories and tags
     */
    $cmb_term = new_cmb2_box(array(
        'id'               => 'iv_term_edit',
        'title'            => esc_html__('Opções', 'iv'), // Doesn't output for term boxes
        'object_types'     => array('term'), // Tells CMB2 to use term_meta vs post_meta
        'taxonomies'       => array('product_cat'), // Tells CMB2 which taxonomies should have these fields
        'new_term_section' => false, // Will display in the "Add New Category" section
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Banner da Categoria (versão desktop)', 'iv'),
        'desc' => esc_html__('Exibido na página da categoria', 'iv'),
        'id'   => 'iv_term_banner_desktop',
        'type' => 'file',
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Banner da Categoria (versão mobile)', 'iv'),
        'desc' => esc_html__('Exibido na página da categoria', 'iv'),
        'id'   => 'iv_term_banner_mobile',
        'type' => 'file',
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Url do Banner', 'iv'),
        'id'   => 'iv_term_banner_url',
        'type' => 'text_url',
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Logo da Categoria', 'iv'),
        'desc' => esc_html__('Exibido na página do produto da categoria', 'iv'),
        'id'   => 'iv_term_logo',
        'type' => 'file',
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Galeria de imagens da Categoria', 'iv'),
        'desc' => esc_html__('Exibido na página do produto da categoria', 'iv'),
        'id'   => 'iv_term_gallery',
        'type' => 'file_list',
    ));

    $cmb_term->add_field(array(
        'name' => esc_html__('Cor da Categoria', 'iv'),
        'id'   => 'iv_term_color',
        'type' => 'colorpicker',
    ));
}
