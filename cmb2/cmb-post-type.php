<?php

add_action('cmb2_admin_init', 'iv_cmb_produto_opcoes');
function iv_cmb_produto_opcoes()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'iv_producto_opcoes_metabox',
        'title'         => esc_html__('Opções Extras', 'iv'),
        'object_types'  => array('product'), // Post type
        'context'       => 'side',
    ));


    $cmb->add_field(array(
        'name'       => esc_html__('Texto de parcelamento', 'iv'),
        'id'         => 'iv_product_parcelamento',
        'type'       => 'text',
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('Avaliação do produto', 'iv'),
        'id'         => 'iv_product_rating',
        'type'             => 'select',
        'show_option_none' => false,
        'options'          => array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5
        ),
    ));
}


add_action('cmb2_admin_init', 'iv_cmb_produto_depoimentos');

function iv_cmb_produto_depoimentos()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'iv_producto_depoimentos_metabox',
        'title'         => esc_html__('Seção "Depoimentos"', 'iv'),
        'object_types'  => array('product'), // Post type
        'closed'        => true
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_produto_depoimentos_gallery',
        'type'        => 'group',
        'description' => esc_html__('Galeria de Depoimentos', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Depoimento #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar novo depoimento', 'iv'),
            'remove_button'  => esc_html__('Remover depoimento', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Vídeo', 'iv'),
        'id'         => 'video',
        'type'       => 'file',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Texto', 'iv'),
        'id'         => 'texto',
        'type'       => 'textarea',
        'attributes' => array(
            'rows' => 2,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Autor', 'iv'),
        'id'         => 'autor',
        'type'       => 'text',
    ));
}

add_action('cmb2_admin_init', 'iv_cmb_produto_historia');

function iv_cmb_produto_historia()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'iv_producto_historia_metabox',
        'title'         => esc_html__('Seção "História"', 'iv'),
        'object_types'  => array('product'), // Post type
        'closed'        => true
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_produto_historia_image_blocks',
        'type'        => 'group',
        'description' => esc_html__('Blocos de Imagem com texto da seção "História"', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Bloco #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar novo bloco', 'iv'),
            'remove_button'  => esc_html__('Remover bloco', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Imagem', 'iv'),
        'id'         => 'imagem',
        'type'       => 'file',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Texto', 'iv'),
        'id'         => 'texto',
        'type'       => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_produto_historia_gallery',
        'type'        => 'group',
        'description' => esc_html__('Galeria de imagens da seção "História"', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Imagem #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar nova imagem', 'iv'),
            'remove_button'  => esc_html__('Remover imagem', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Imagem', 'iv'),
        'id'         => 'imagem',
        'type'       => 'file',
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('Texto da galeria de imagens da seção "História"', 'iv'),
        'id'         => 'iv_produto_historia_gallery_text',
        'type'       => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
        // 'show_option_none' => true,
    ));
}


add_action('cmb2_admin_init', 'iv_cmb_produto_descricao');

function iv_cmb_produto_descricao()
{
    $cmb = new_cmb2_box(array(
        'id'            => 'iv_producto_descricao_metabox',
        'title'         => esc_html__('Seção "Descrição"', 'iv'),
        'object_types'  => array('product'), // Post type
        'closed'        => true
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'iv_produto_descricao_carousel',
        'type'        => 'group',
        'description' => esc_html__('Carrossel da seção "Descrição"', 'iv'),
        'options'     => array(
            'group_title'    => esc_html__('Item #{#}', 'iv'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Adicionar novo item', 'iv'),
            'remove_button'  => esc_html__('Remover item', 'iv'),
            'sortable'       => true,
        ),
    ));

    $cmb->add_group_field($group_field_id, array(
        'name'       => esc_html__('Texto do item do carrossel', 'iv'),
        'id'         => 'texto',
        'type'       => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('Título da seção "Descrição"', 'iv'),
        'id'         => 'iv_produto_descricao_title',
        'type'       => 'text',
        // 'show_option_none' => true,
    ));

    $cmb->add_field(array(
        'name'       => esc_html__('Imagem da seção "Descrição"', 'iv'),
        'id'         => 'iv_produto_descricao_image',
        'type'       => 'file',
        // 'show_option_none' => true,
    ));
}
