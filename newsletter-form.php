<?php
$email = '';
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $nome = $user->first_name && $user->last_name ?
        $user->first_name . ' ' . $user->last_name :
        $user->display_name;
    $email = $user->user_email;
}
$wt_add_contact_form_nonce = wp_create_nonce('wt_contact_form_nonce');
?>
<form class="wt-newsletter-form needs-validation newsletter-form" role="search" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="wt-newsletter-form" novalidate>

    <div class="row">

        <div class="mb-3">
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" autocomplete="off" aria-autocomplete="list" aria-label="<?php echo __('E-mail', 'wt'); ?>" placeholder="<?php echo __('Seu endereço de e-mail', 'wt'); ?>" required>
            <div class="invalid-feedback"><?php echo __('Campo obrigatório', 'wt'); ?></div>
        </div>

        <div class="mb-3">
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-light"><?php echo __('Enviar', 'wt'); ?></button>
            </div>
        </div>

    </div>

    <input type="hidden" name="wt_newsletter_form_nonce" value="<?php echo $wt_add_newsletter_form_nonce; ?>" />
    <input type="hidden" value="wt_newsletter_form" name="action">

</form>
<div id="newsletter-form-alert-placeholder"></div>