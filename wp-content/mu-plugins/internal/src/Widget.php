<?php
class Widget
{
	private $id = -1;
    private $item = [];



    public function register($name)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['name'] = $name;
        return $this;
    }



    public function setId($id)
    {
    	$this->item[$this->id]['id'] = $id;
        return $this;
    }



    public function beforeWidget($beforeWidget)
    {
        $this->item[$this->id]['before_widget'] = $beforeWidget;
        return $this;
    }



    public function afterWidget($afterWidget)
    {
        $this->item[$this->id]['after_widget'] = $afterWidget;
        return $this;
    }



    public function beforeTitle($beforeTitle)
    {
        $this->item[$this->id]['before_title'] = $beforeTitle;
        return $this;
    }



    public function afterTitle($afterTitle)
    {
        $this->item[$this->id]['after_title'] = $afterTitle;
        return $this;
    }



    public function add()
    {
        $name           = $this->item[$this->id]['name'];
        $id             = $this->item[$this->id]['id'];
        $before_widget  = isset($this->item[$this->id]['before_widget']) ? $this->item[$this->id]['before_widget'] : '<li id="%1$s" class="widget %2$s">';
        $after_widget   = isset($this->item[$this->id]['after_widget']) ? $this->item[$this->id]['after_widget'] : '</li>';
        $before_title   = isset($this->item[$this->id]['before_title']) ? $this->item[$this->id]['before_title'] : '<h2 class="widgettitle">';
        $after_title    = isset($this->item[$this->id]['after_title']) ? $this->item[$this->id]['after_title'] : '</h2>';

        register_sidebar([
            'name'          => __( $name, 'sidebar-stepforward' ),
            'id'            => 'sidebar-' . $id,
            'before_widget' => $before_widget,
            'after_widget'  => $after_widget,
            'before_title'  => $before_title,
            'after_title'   => $after_title
        ]);
    }
}
