<?php
class MetaBox
{
	private $id   = -1;
	private $item = [];



    public function register($name)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['name'] = $name;

        return $this;
    }



    public function setLabel($label)
    {
        $this->item[$this->id]['label'] = $label;
        return $this;
    }



    public function setForm($form)
    {
        $this->item[$this->id]['form'] = $form;
        return $this;
    }



    public function setContext($context)
    {
        $this->item[$this->id]['context'] = $context;
        return $this;
    }



    public function setPriority($priority)
    {
        $this->item[$this->id]['priority'] = $priority;
        return $this;
    }



    public function addToPostType($postType)
    {
        $this->item[$this->id]['post_type'] = $postType;
        return $this;
    }



    public function add()
    {
        $name       = $this->item[$this->id]['name'];
        $label      = $this->item[$this->id]['label'];
        $form       = $this->item[$this->id]['form'];
        $postType   = $this->item[$this->id]['post_type'];
        $context    = isset($this->item[$this->id]['context']) ? $this->item[$this->id]['context'] : 'normal' ;
        $priority   = isset($this->item[$this->id]['priority']) ? $this->item[$this->id]['priority'] : 'default';

        add_meta_box(
            $name,
            $label,
            $form,
            $postType,
            $context,
            $priority
        );
    }
}
