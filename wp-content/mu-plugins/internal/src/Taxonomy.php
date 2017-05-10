<?php
class Taxonomy
{
    private $id = -1;
    private $item = [];


    public function register($singularName, $pluralName)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['singular_name'] = $singularName;
        $this->item[$this->id]['plural_name'] = $pluralName;
        $this->item[$this->id]['arguments'] = [];
        return $this;
    }


    public function setMenuName($menuname)
    {
        $this->item[$this->id]['menu_name'] = $menuname;
        return $this;
    }


    public function setHierarchical($hierarchical = true)
    {
        $this->item[$this->id]['hierarchical'] = $hierarchical;
        return $this;
    }


    public function setSlug($slug)
    {
        $this->item[$this->id]['slug'] = $slug;
        return $this;
    }

    public function showUI($showUI = true)
    {
        $this->item[$this->id]['show_ui'] = $showUI;
        return $this;
    }

    public function hideUI()
    {
        $this->item[$this->id]['show_ui'] = false;
        return $this;
    }

    public function showAdminColumn($showAdminColumn = true)
    {
        $this->item[$this->id]['show_admin_column'] = $showAdminColumn;
        return $this;
    }

    public function hideAdminColumn()
    {
        $this->item[$this->id]['show_admin_column'] = false;
        return $this;
    }

    public function setArguments($keys, $value = null)
    {
        if (is_array($keys)) {
            foreach($keys as $key => $value) :
                $this->item[$this->id]['arguments'][$key] = $value;
            endforeach;
        } else {
            $this->item[$this->id]['arguments'][$keys]= $value;
        }

        return $this;
    }


    public function addToPostType($postType)
    {
        $singularName   = $this->item[$this->id]['singular_name'];
        $pluralName     = $this->item[$this->id]['plural_name'];
        $menuName       = isset($this->item[$this->id]['menu_name']) ? $this->item[$this->id]['menu_name'] : $pluralName;
        $hierarchical   = isset($this->item[$this->id]['hierarchical']) ? $this->item[$this->id]['hierarchical'] : false;
        $showUI         = isset($this->item[$this->id]['show_ui']) ? $this->item[$this->id]['show_ui'] : true;
        $showAdminColumn = isset($this->item[$this->id]['show_admin_column']) ? $this->item[$this->id]['show_admin_column'] : false;
        $slug           = isset($this->item[$this->id]['slug']) ? $this->item[$this->id]['slug'] : strtolower(str_replace(' ', '_', $singularName));

        $labels = [
            'name'              => _x( $pluralName, 'taxonomy general name' ),
            'singular_name'     => _x( $singularName, 'taxonomy singular name' ),
            'search_items'      => __( 'Search ' . $pluralName ),
            'all_items'         => __( 'All ' . $pluralName ),
            'parent_item'       => __( 'Parent ' . $singularName ),
            'parent_item_colon' => __( 'Parent ' . $singularName . ' :' ),
            'edit_item'         => __( 'Edit ' . $singularName ),
            'update_item'       => __( 'Update ' . $singularName ),
            'add_new_item'      => __( 'Add New ' . $singularName ),
            'new_item_name'     => __( 'New ' . $singularName . ' Name' ),
            'menu_name'         => __( $menuName ),
        ];

        $args = [];
        $args['hierarchical']      = $hierarchical;
        $args['labels']            = $labels;
        $args['show_ui']           = $showUI ;
        $args['show_admin_column'] = $showAdminColumn ;
        $args['rewrite']['slug']   = $slug ;


        if ($this->item[$this->id]['arguments']) {
            foreach($this->item[$this->id]['arguments'] as $key => $value) :
                $args[$key] = $value;
            endforeach;
        }

        register_taxonomy($slug, $postType, $args);
    }
}
