<?php

add_action('init', 'iv_leads', 1);

function iv_leads()
{
    $lead = new Iv_Post_Type(
        'Lead',
        'lead'
    );

    $lead->set_labels(
        array(
            'menu_name' => __('Leads', 'iv')
        )
    );

    $lead->set_arguments(
        array(
            'supports' => array(''),
            'menu_icon'     => 'dashicons-email'
        )
    );
}
