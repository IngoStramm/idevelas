<?php

add_action('cmb2_admin_init', 'iv_register_theme_options_metabox');
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function iv_register_theme_options_metabox()
{

    /**
     * Registers options page menu item and form.
     */
    $cmb_options = new_cmb2_box(array(
        'id'           => 'iv_theme_options_page',
        'title'        => esc_html__('Configurações Ide Velas', 'iv'),
        'object_types' => array('options-page'),

        /*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

        'option_key'      => 'iv_theme_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'              => esc_html__( 'Options', 'iv' ), // Falls back to 'title' (above).
        // 'parent_slug'             => 'themes.php', // Make options page a submenu item of the themes menu.
        // 'capability'              => 'manage_options', // Cap required to view options-page.
        // 'position'                => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook'         => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'priority'                => 10, // Define the page-registration admin menu hook priority.
        // 'display_cb'              => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'             => esc_html__( 'Save Theme Options', 'iv' ), // The text for the options-page save button. Defaults to 'Save'.
        // 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
        // 'message_cb'              => 'iv_options_page_message_callback',
        // 'tab_group'               => '', // Tab-group identifier, enables options page tab navigation.
        // 'tab_title'               => null, // Falls back to 'title' (above).
        // 'autoload'                => false, // Defaults to true, the options-page option will be autloaded.
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mails que receberão as mensagens do formulário de contato.', 'iv'),
        'id'      => 'iv_contact_form_emails',
        'type'    => 'text_email',
        'repeatable'    => true,
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mails que receberão as mensagens do formulário de newsletter.', 'iv'),
        'id'      => 'iv_newsletter_form_emails',
        'type'    => 'text_email',
        'repeatable'    => true,
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto da barra no topo do site.', 'iv'),
        'description' => esc_html__('Se este campo estiver vazio, a barra no topo do site não será exibida.'),
        'id'      => 'iv_topbar_text',
        'type'    => 'text'
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Número do WhatsApp.', 'iv'),
        'id'      => 'iv_whatsapp',
        'type'    => 'text'
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mail de contato da loja.', 'iv'),
        'id'      => 'iv_email',
        'type'    => 'text_email'
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Razão Social da loja.', 'iv'),
        'id'      => 'iv_razao_social',
        'type'    => 'text'
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Inscrição Estadual da loja.', 'iv'),
        'id'      => 'iv_inscricao_estadual',
        'type'    => 'text'
    ));

    $cmb_options->add_field(array(
        'name' => esc_html__('Imagem padrão', 'cmb2'),
        'desc' => esc_html__('A imagem padrão será exibido quando o comprador não definir uma imagem para o anúncio.', 'cmb2'),
        'id'   => 'iv_anuncio_default_image',
        'type' => 'file',
        'attributes' => array(
            'accept' => '.jpg,.jpeg,.png'
        )
    ));
}

add_action('cmb2_admin_init', 'iv_register_giftbox_options_metabox');

function iv_register_giftbox_options_metabox() {
    $cmb_options = new_cmb2_box(array(
        'id'           => 'iv_giftbox_options_page',
        'title'        => esc_html__('Giftbox', 'iv'),
        'object_types' => array('options-page'),
        'option_key'      => 'iv_giftbox_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'              => esc_html__( 'Options', 'iv' ), // Falls back to 'title' (above).
        'parent_slug'             => 'iv_theme_options', // Make options page a submenu item of the themes menu.
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Título', 'iv'),
        'id'      => 'iv_giftbox_titulo',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto abaixo do título', 'iv'),
        'id'      => 'iv_giftbox_text',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto em destaque', 'iv'),
        'id'      => 'iv_giftbox_destaque',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do link', 'iv'),
        'id'      => 'iv_giftbox_link_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto do Link', 'iv'),
        'id'      => 'iv_giftbox_link_text',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Imagem', 'iv'),
        'id'      => 'iv_giftbox_image',
        'type'    => 'file',
    ));

}

add_action('cmb2_admin_init', 'iv_register_ide_options_metabox');

function iv_register_ide_options_metabox()
{
    $cmb_options = new_cmb2_box(array(
        'id'           => 'iv_ide_options_page',
        'title'        => esc_html__('Ide', 'iv'),
        'object_types' => array('options-page'),
        'option_key'      => 'iv_ide_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'              => esc_html__( 'Options', 'iv' ), // Falls back to 'title' (above).
        'parent_slug'             => 'iv_theme_options', // Make options page a submenu item of the themes menu.
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Imagem', 'iv'),
        'id'      => 'iv_ide_image',
        'type'    => 'file',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto principal', 'iv'),
        'id'      => 'iv_ide_main_text',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto secundário', 'iv'),
        'id'      => 'iv_ide_sec_text',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3,
            'media_buttons' => false
        ),
    ));

}