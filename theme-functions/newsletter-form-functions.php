<?php

function iv_log_lead_errors($wp_error)
{
    $fn = ABSPATH . '/wp-content/lead.log';
    $fp = fopen($fn, 'a');
    fputs($fp, date('d/m/Y H:i:s') . " - Lead Error: " . $wp_error->get_error_message() . "\n");
    fclose($fp);
}
function iv_get_field_value($name)
{
    $value = isset($_POST[$name]) && !is_null($_POST[$name]) ? $_POST[$name] : null;
    if (!$value) {
        // retorna uma mensagem de erro com o campo 'success' falso
        wp_send_json_error(array('msg' => __("Campo \"$name\" não foi passado ou está vazio.", 'cl')), 200);
    }
    return $value;
}

add_action('wp_ajax_nopriv_iv_newsletter_form', 'iv_newsletter_form');
add_action('wp_ajax_iv_newsletter_form', 'iv_newsletter_form');
// add_action('admin_post_nopriv_iv_newsletter_form', 'iv_newsletter_form');
// add_action('admin_post_iv_newsletter_form', 'iv_newsletter_form');

function iv_newsletter_form()
{
    // iv_debug('teste');
    // die;

    if (!isset($_POST['iv_newsletter_form_nonce']) || !wp_verify_nonce($_POST['iv_newsletter_form_nonce'], 'iv_newsletter_form_nonce')) {
        wp_send_json_error(array('msg' => __('Não foi possível validar a requisição.', 'iv')), 200);
    }


    $fields = array('email');
    $data = [];
    foreach ($fields as $name) {
        $data[$name] = iv_get_field_value($name);
    }

    // Salvar os leads no wp
    $title = sprintf(__('Lead gerado pelo formulário de Newsletter a partir do e-mail "%s"', 'iv'), $data['email']);
    $postarr = [
        'post_title'        => $title,
        'post_status'       => 'publish',
        'post_type'         => 'lead',
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'meta_input'        => array(
            'lead_type'  => 'newsletter',
            'lead_email'  => $data['email'],
        )
    ];
    $lead_id = wp_insert_post($postarr, true);
    if (is_wp_error($lead_id)) {
        iv_log_lead_errors($lead_id);
    }

    $send_to_emails = iv_get_option('iv_newsletter_form_emails');
    $to = $send_to_emails;
    $subject = sprintf(__('Newsletter | %s', 'iv'), get_bloginfo('name'));
    $body = '';
    $body .= '<p>' . sprintf(__('Email: "%s"', 'iv'), $data['email']) . '</p>';
    $send_email_notification = iv_mail($to, $subject, $body);

    if (!$send_email_notification) {
        wp_send_json_error(array('msg' => __('Ocorreu um erro ao tentar enviar a sua mensagem.', 'iv')), 200);
    }

    $response = array(
        'msg'                   => __('Mensagem enviada com sucesso!', 'iv'),
    );

    wp_send_json_success($response);
}
