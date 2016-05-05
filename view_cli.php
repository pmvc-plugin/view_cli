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
        if (!empty($all)) {
            \PMVC\plug('cli')->dump($all,'%C');
        }
    }

    /**
     * set veiw
     */
     public function set($k, $v=null)
     {
        if ($this['flush']) {
            return \PMVC\plug('cli')->dump($k.' '.$v,'%C');
        } else {
            return parent::set($k, $v);
        }
     }
}
