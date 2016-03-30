<?php
namespace PMVC\PlugIn\view;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\view_cli';

class view_cli extends ViewEngine
{
    public function process()
    {
        if (!empty($this['forward']->action)) {
            return;
        }
        $all = $this->get();
        \PMVC\plug('cli')->dump($all,'%C');
    }

    /**
     * set veiw
     */
     public function set($k, $v=null)
     {
        if ($this['flush']) {
            \PMVC\plug('cli')->dump($k.' '.$v,'%C');
        } else {
            return p\set($this->_view, $k, $v);
        }
     }
}
