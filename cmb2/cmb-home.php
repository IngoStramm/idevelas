<?php

function iv_show_if_front_page($cmb)
{
    // Don't show this metabox if it's not the front page template.
    if (get_option('page_on_front') !== $cmb->object_id) {
        return false;
    }
    return true;
}

add_action('cmb2_admin_init', 'iv_register_homepage_metabox');
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function iv_register_homepage_metabox()
{
    /**
     * Sample metabox to demonstrate each field type included
     */
    $cmb = new_cmb2_box(array(
        'id'            => 'iv_homepage_metabox',
        'title'         => esc_html__('Opções', 'iv'),
        'object_types'  => array('page'), // Post type
        // 'show_on_cb' => 'iv_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'iv_add_some_classes', // Add classes through a callback.
        // 'mb_callback_args' => array( '__block_editor_compatible_meta_box' => false ),
    ));


    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_home_banner_desktop',
        'type'        => 'group',
        'description' => esc_html__('Banner principal versão Desktop', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Banner #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar novo banner', 'iv'),
            'remove_button'  => esc_html__('Remover banner', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Imagem', 'iv'),
        'id'         => 'image',
        'type'       => 'file',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Link', 'iv'),
        'id'         => 'url',
        'type'       => 'text_url',
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_home_banner_mobile',
        'type'        => 'group',
        'description' => esc_html__('Banner principal versão Mobile', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Banner #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar novo banner', 'iv'),
            'remove_button'  => esc_html__('Remover banner', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Imagem', 'iv'),
        'id'         => 'image',
        'type'       => 'file',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Link', 'iv'),
        'id'         => 'url',
        'type'       => 'text_url',
    ));

    $cmb->add_field(array(
        'name' => esc_html__('Categoria em destaque', 'iv'),
        'id'   => 'iv_home_cat',
        'type' => 'select',
        'show_option_none' => true,
        'options_cb' => 'iv_get_product_terms'
    ));
}

function iv_get_product_terms()
{
    $options = [];
    $args = array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    );
    $terms = get_terms($args);
    foreach ($terms as $term) {
        $options[$term->term_id] = $term->name;
    }
    return $options;
}
