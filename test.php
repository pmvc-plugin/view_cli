<?php
PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
class View_cliTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'view_cli';

    function setup()
    {
        \PMVC\unplug($this->_plug);
    }

    function testPlugin()
    {
        ob_start();
        print_r(PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

    function testDumpMultiArray()
    {
        $v = \PMVC\plug($this->_plug);
        $arr = [
            'a'=>[
                'b'=>'c'
            ],
            'd'=>'e'
        ];
        $v->append($arr);
        ob_start();
        $v->process();
        $output = ob_get_contents();
        ob_end_clean();
        $expected = "'a[b]' => 'c',";
        $this->assertContains($expected,$output);
    }

    function testDumpKV()
    {
        $v = \PMVC\plug($this->_plug);
        $v['flush'] = 1;
        $v['plainText'] = 1;
        ob_start();
        $v->set('k', 'v');
        $output = ob_get_contents();
        ob_end_clean();
        $expected = 'k: v'."\n";
        $this->assertEquals($expected,$output);
    }

    function testDumpK()
    {
        $v = \PMVC\plug($this->_plug);
        $v['flush'] = 1;
        $v['plainText'] = 1;
        ob_start();
        $v->set('k');
        $output = ob_get_contents();
        ob_end_clean();
        $expected = 'k'."\n";
        $this->assertEquals($expected,$output);
    }

}
