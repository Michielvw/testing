<?php
class CSSQueue
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



    public function setUrl($url)
    {
        $this->item[$this->id]['url'] = $url;
        return $this;
    }



    public function setDependency($dep)
    {
        $this->item[$this->id]['dep'] = $dep;
        return $this;
    }



    public function setVersion($version)
    {
        $this->item[$this->id]['version'] = $version;
        return $this;
    }



    public function save()
    {
        $dep = isset($this->item[$this->id]['dep']) ? $this->item[$this->id]['dep'] : [];
        $version = isset($this->item[$this->id]['version']) ? $this->item[$this->id]['version'] : null;

        wp_register_style($this->item[$this->id]['name'], $this->item[$this->id]['url'], $dep, $version);
    }



    public function enqueue($name = null)
    {
        if ($name) {
            wp_enqueue_style($name);
        } else {
            $this->save();
            wp_enqueue_style($this->item[$this->id]['name']);
        }
    }



    public function deregister($name)
    {
        wp_deregister_style($name);
    }



    public function dequeue($name)
    {
        wp_dequeue_style($name);
    }
}
