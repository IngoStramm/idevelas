<?php

/**
 * IV_Post_Type class.
 *
 * Built Custom Post Types.
 *
 * @package  Odin
 * @category Post Types
 * @author   WPBrasil
 * @version  2.1.4
 */
class IV_Post_Type
{

    /**
     * Array of labels for the post type.
     *
     * @var array
     */
    protected $labels = array();

    /**
     * Post type arguments.
     *
     * @var array
     */
    protected $arguments = array();

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * slug
     *
     * @var string
     */
    protected $slug = '';

    /**
     * Construct Post Type.
     *
     * @param string $name       Singular name.
     * @param string $slug       Post type slug.
     */
    public function __construct($name, $slug)
    {
        $this->name = $name;
        $this->slug = $slug;

        // Register post type.
        add_action('init', array(&$this, 'register_post_type'));
    }

    /**
     * Set custom labels.
     *
     * @param array $labels Custom labels.
     */
    public function set_labels($labels = array())
    {
        $this->labels = $labels;
    }

    /**
     * Set custom arguments.
     *
     * @param array $arguments Custom arguments.
     */
    public function set_arguments($arguments = array())
    {
        $this->arguments = $arguments;
    }

    /**
     * Define Post Type labels.
     *
     * @return array Post Type labels.
     */
    protected function labels()
    {
        $default = array(
            'name'               => sprintf(__('%ss', 'iv'), $this->name),
            'singular_name'      => sprintf(__('%s', 'iv'), $this->name),
            'view_item'          => sprintf(__('Ver %s', 'iv'), $this->name),
            'edit_item'          => sprintf(__('Editar %s', 'iv'), $this->name),
            'search_items'       => sprintf(__('Pesquisar %s', 'iv'), $this->name),
            'update_item'        => sprintf(__('Atualizar %s', 'iv'), $this->name),
            'parent_item_colon'  => sprintf(__('%s Pai:', 'iv'), $this->name),
            'menu_name'          => sprintf(__('%ss', 'iv'), $this->name),
            'add_new'            => __('Adicionar Novo', 'iv'),
            'add_new_item'       => sprintf(__('Adicionar Novo %s', 'iv'), $this->name),
            'new_item'           => sprintf(__('Novo %s', 'iv'), $this->name),
            'all_items'          => sprintf(__('Todos %ss', 'iv'), $this->name),
            'not_found'          => sprintf(__('Nenhum %s encontrado', 'iv'), $this->name),
            'not_found_in_trash' => sprintf(__('Nenhum %s encontrado na lixeira', 'iv'), $this->name)
        );

        return array_merge($default, $this->labels);
    }

    /**
     * Define Post Type arguments.
     *
     * @return array Post Type arguments.
     */
    protected function arguments()
    {
        $default = array(
            'labels'              => $this->labels(),
            'hierarchical'        => false,
            'supports'            => array('title', 'editor', 'thumbnail', 'comments', 'revisions'),
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'has_archive'         => true,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post'
        );

        return array_merge($default, $this->arguments);
    }

    /**
     * Register Post Type.
     */
    public function register_post_type()
    {
        register_post_type($this->slug, $this->arguments());
    }
}
