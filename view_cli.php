<?php
namespace PMVC\PlugIn\view;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\view_cli';

/**
 * @parameters bool $flush 
 * @parameters bool $plainText 
 */
class view_cli extends ViewEngine
{

    private function _dump()
    {
        $data = func_get_args();
        $data = \PMVC\plug('underscore')->array()->toQuery($data);
        $data = array_diff($data, [null]);
        if (1 <= array_sum(array_map('is_int', array_keys($data)))) {
            $data = join(': ', $data);
        }
        if ($this['plainText']) {
            echo $data."\n";
        } else {
            \PMVC\plug('cli')->dump($data,'%C');
        }
    }

    public function process()
    {
        if (!empty($this['forward']->action)) {
            return;
        }
        $all = $this->get();
        if (!empty($all)) {
            $this->_dump($all);
        }
    }

    /**
     * Set theme 
     */
    public function setThemeFolder($val) { }
    public function setThemePath($val) { }

    /**
     * set veiw
     */
     public function set($k, $v=null)
     {
        if ($this['flush']) {
            $this->_dump($k, $v);
        } else {
            return parent::set($k, $v);
        }
     }
}
