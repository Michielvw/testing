<?php
class PostType
{
    private $id   = -1;
    private $item = [];

    public function register($singularName, $pluralName)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['singular_name'] = $singularName;
        $this->item[$this->id]['plural_name']   = $pluralName;

        return $this;
    }

    public function setId($id)
    {
        $this->item[$this->id]['id'] = $id;
        return $this;
    }

    public function setSlug($slug)
    {
        $this->item[$this->id]['slug'] = $slug;
        return $this;
    }

    public function setSupports($supports)
    {
        $this->item[$this->id]['supports'] = $supports;
        return $this;
    }

    public function setHierarchical($hierarchical = true)
    {
        $this->item[$this->id]['hierarchical'] = $hierarchical;
        return $this;
    }

    public function add()
    {

        $singularName = $this->item[$this->id]['singular_name'];
        $pluralName   = $this->item[$this->id]['plural_name'];
        $id           = isset($this->item[$this->id]['id']) ? $this->item[$this->id]['id'] : strtolower(str_replace(' ', '_', $singularName));
        $slug         = isset($this->item[$this->id]['slug']) ? $this->item[$this->id]['slug'] : $id;
        $hierachical  = isset($this->item[$this->id]['hierarchical']) ? $this->item[$this->id]['hierarchical'] : false;
        $supports     = isset($this->item[$this->id]['supports']) ? $this->item[$this->id]['supports'] : ['title','editor','thumbnail'];

        $labels = [
            'name'                  => __($pluralName, 'text_domain'),
            'singular_name'         => __($singularName, 'text_domain'),
            'menu_name'             => __($pluralName, 'text_domain' ),
            'name_admin_bar'        => __($singularName, 'text_domain' ),
            'add_new'               => __('Add New', 'text_domain'),
            'all_items'             => __('All ' .$pluralName, 'text_domain' ),
            'add_new_item'          => __('Add New ' .$singularName, 'text_domain'),
            'edit_item'             => __('Edit ' . $singularName, 'text_domain'),
            'new_item'              => __('New ' . $singularName, 'text_domain'),
            'view_item'             => __('View ' . $singularName, 'text_domain'),
            'search_items'          => __('Search ' . $pluralName, 'text_domain'),
            'not_found'             =>  __('Nothing found', 'text_domain'),
            'not_found_in_trash'    => __('Nothing found in Trash', 'text_domain'),
            'parent_item_colon'     => '',
            'items_list'            => __( $pluralName . ' list', 'text_domain' ),
            'items_list_navigation' => __( $pluralName . ' list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter' . $pluralName . 'list', 'text_domain' )
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'query_var'          => true,
            //'rewrite'          => false,
            'rewrite'            => ['slug' => $slug, 'with_front' => false],
            'capability_type'    => 'page',
            'hierarchical'       => $hierachical,
            'menu_position'      => 20,
            'supports'           => $supports
        ];

        register_post_type($id, $args);
    }
}
