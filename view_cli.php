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
}
