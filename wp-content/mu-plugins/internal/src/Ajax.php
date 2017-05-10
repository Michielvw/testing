<?php
class Ajax
{
    private $id = -1;
    private $item = [];


    public function register($action)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['action'] = $action;
        $this->item[$this->id]['is_private'] = false;
        return $this;
    }



    public function registerAction($action)
    {
        $this->register($action);
    }



    public function setPrivate()
    {
        $this->item[$this->id]['is_private'] = true;
        return $this;
    }



    public function setController($controller)
    {
        add_action('wp_ajax_' . $this->item[$this->id]['action'], [$controller, 'ajax']);

        if (!$this->item[$this->id]['is_private']) {
            add_action('wp_ajax_nopriv_' . $this->item[$this->id]['action'], [$controller, 'ajax']);
        }
    }



    public function useController($controller)
    {
        $this->setController($controller);
    }
}
