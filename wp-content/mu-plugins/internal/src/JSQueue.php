<?php
class JSQueue
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



    public function putOnHeader()
    {
        $this->item[$this->id]['in_footer'] = false;
        return $this;
    }



    public function putOnFooter()
    {
        $this->item[$this->id]['in_footer'] = true;
        return $this;
    }



    public function setVersion($version)
    {
        $this->item[$this->id]['version'] = $version;
        return $this;
    }



    public function setGlobalObject($array)
    {
        $this->item[$this->id]['localize'] = [
            'name' => $array['name'],
            'value' => $array['value']
        ];

        return $this;
    }



    public function save()
    {
        $dep = isset($this->item[$this->id]['dep']) ? $this->item[$this->id]['dep'] : [];
        $version = isset($this->item[$this->id]['version']) ? $this->item[$this->id]['version'] : null;
        $localize = isset($this->item[$this->id]['localize']) ? $this->item[$this->id]['localize'] : false;
        $inFooter = isset($this->item[$this->id]['in_footer']) ? $this->item[$this->id]['in_footer'] : true;

        wp_register_script($this->item[$this->id]['name'], $this->item[$this->id]['url'], $dep, $version, $inFooter);

        if ($localize) {
            wp_localize_script(
                $this->item[$this->id]['name'],
                $this->item[$this->id]['localize']['name'],
                $this->item[$this->id]['localize']['value']
            );
        }
    }



    public function enqueue($name = null)
    {
        if ($name) {
            wp_enqueue_script($name);
        } else {
            $this->save();
            wp_enqueue_script($this->item[$this->id]['name']);
        }
    }



    public function deregister($name)
    {
        wp_deregister_script($name);
    }



    public function dequeue($name)
    {
        wp_dequeue_script($name);
    }
}
