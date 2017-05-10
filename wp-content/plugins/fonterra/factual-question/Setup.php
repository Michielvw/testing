<?php
namespace Plugin\FactualQuestion;

defined('ABSPATH') or die('Can\'t access directly');

class Setup
{
    private $_dir;
    private $_url;

    public function __construct()
    {
        $this->_dir = INTERNAL_PLUGIN_DIR . '/factual-question';
        $this->_url = INTERNAL_PLUGIN_URL . '/factual-question';

        $this->registerPostTypes();

        add_action('wp', [$this, 'enqueue']);

        add_action('manage_factualquestion_posts_custom_column', [$this, 'custom_columns_factual'], 10, 2);
        add_filter('manage_factualquestion_posts_columns', [$this, 'custom_columns_head']);
        add_action('manage_edit-factualquestion_sortable_columns', [$this, 'activitySortColumns']);

    }

    public function registerPostTypes()
    {
        $level = tr_taxonomy('level');

        $factual_question = tr_post_type('factual-question')
        ->setSlug('factualquestion')
        ->setId('factualquestion')
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

    function custom_columns_factual($column_name, $post_ID) {
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
// end custom colomn admin

    public function enqueue()
    {
        if (is_page('factualquestion'))
            add_action('wp_enqueue_scripts', [$this, 'factualquestionStyling'], 11);
    }

    public function factualquestionStyling() {
        $js     = \xpress::js();
        $css    = \xpress::css();

        $css
        ->register('toolkit-style')
        ->setUrl($this->_url . '/assets/css/factualquestion.css')
        ->enqueue();

        $js
        ->register('toolkit-scripts')
        ->setUrl($this->_url . '/assets/js/factualquestion.js')
        ->setDependency(['jquery', 'functions'])
        ->enqueue();
    }

} //end class

new Setup();
