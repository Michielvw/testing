<?php
namespace Plugin\DilemmaQuestion;

defined('ABSPATH') or die('Can\'t access directly');

class Setup
{
    private $_dir;
    private $_url;

    public function __construct()
    {
        $this->_dir = INTERNAL_PLUGIN_DIR . '/dilemma-question';
        $this->_url = INTERNAL_PLUGIN_URL . '/dilemma-question';
        $this->registerPostTypes();

        add_action( 'current_screen', [$this,'checkScreen'] );

        add_action('manage_dilemmaquestion_posts_custom_column', [$this, 'custom_columns_dilemma'], 10, 2);
        add_filter('manage_dilemmaquestion_posts_columns', [$this, 'custom_columns_head']);
        add_action('manage_edit-dilemmaquestion_sortable_columns', [$this, 'activitySortColumns']);
        add_action('pre_get_posts', [$this, 'my_pre_get_posts']);
    }


    public function registerPostTypes()
    {
        $level = tr_taxonomy('level');

        $factual_question = tr_post_type('dilemma-question')
        ->setSlug('dilemmaquestion')
        ->setId('dilemmaquestion')
        ->setArgument('supports', ['title','editor','comments','thumbnail'])
        ->setIcon('wrench');

        $level->apply($factual_question);
    }
// custom colomn admin
    function custom_columns_head($defaults) {
        $new = [];
        $defaults['level'] = 'Level';
        $defaults['order'] = 'Order';
  		$defaults['mydate']  = 'Date';

        unset($defaults['level']);
        unset($defaults['order']);
        unset($defaults['date']);

		foreach($defaults as $key=>$value) {
	        if($key=='mydate') {
               $new['level'] = 'Level';
               $new['order'] = 'order';
	        }
	        $new[$key] = $value;
	    }
	    return $new;
    }

    function custom_columns_dilemma($column_name, $post_ID) {
        if ($column_name == 'level') {
            $level_id = get_field('level_id');
            $level_name = get_term_by('id', $level_id, 'level');
            if ($level_id) {
                echo $level_name->name;
            }
            else {
                # code...
            }
        }
        elseif ($column_name == 'mydate') {
			echo 'Last edit by <br>' . get_the_time( 'F j, Y', $post_ID );
        }
        elseif ($column_name == 'order') {
            $order  = get_field('order');
            echo $order;
        }
    }
    public function activitySortColumns( $columns ){
        $columns['level']   = 'level';
        $columns['order']   = 'order';
		$columns['mydate']  = 'mydate';

		return $columns;
	}
    public function my_pre_get_posts( $query ) {
		$orderby = $query->get('orderby');
		$order   = $query->get('order');

		if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'dilemmaquestion' && $orderby == 'level' && $order == 'asc') {
			$query->set('orderby', 'meta_value');
			$query->set('meta_key', 'level_id');
			$query->set('order', 'ASC');
		} else if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'dilemmaquestion' && $orderby == 'level' && $order == 'desc') {
			$query->set('orderby', 'meta_value');
			$query->set('meta_key', 'level_id');
			$query->set('order', 'DESC');
		} else if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'dilemmaquestion' && $orderby == 'order' && $order == 'desc') {
			$query->set('orderby', 'meta_value');
			$query->set('meta_key', 'order');
			$query->set('order', 'DESC');
        } else if( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'dilemmaquestion' && $orderby == 'order' && $order == 'asc') {
			$query->set('orderby', 'meta_value');
			$query->set('meta_key', 'order');
			$query->set('order', 'ASC');
        }
		return $query;
	}
// end custom colomn admin


    public function checkScreen($current_screen)
    {
        if ($current_screen->id != 'dilemmaquestion') return;
        add_action('admin_enqueue_scripts', [$this, 'adminScripts']);
    }

    public function adminScripts() {
        $css    = \xpress::css();

        $css
        ->register('meta-box')
        ->setUrl($this->_url . '/assets/css/meta-box.css')
        ->setVersion('1.0.0')
        ->enqueue();

    }

} //end class

new Setup();
