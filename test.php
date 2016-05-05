<?php
PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
class View_cliTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'view_cli';
    function testPlugin()
    {
        ob_start();
        print_r(PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

}
