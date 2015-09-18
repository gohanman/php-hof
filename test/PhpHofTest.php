<?php

namespace gohanman\phphof;

class PhpHofTest extends \PHPUnit_Framework_TestCase
{
    private function getTestArray()
    {
        return array(
            'one'=>1,
            'two'=>2,
            'three'=>3,
            'four'=>4,
        );
    } 

    public function testMap()
    {
        $result = HOF::map($this->getTestArray(),
            function ($item) {
                return new Tuple($item->key(), strlen($item->key()) + $item->value());
            });
        $expect = array(
            'one' => 4,
            'two' => 5,
            'three' => 8,
            'four' => 8,
        );
        $this->assertEquals($result === $expect, true);
    }

    public function testFilter()
    {
        $result = HOF::filter($this->getTestArray(),
            function ($item) {
                if (strlen($item->key()) == 3 && $item->value() % 2 == 0) {
                    return true;
                } else {
                    return false;
                }
            });
        $expect = array(
            'two' => 2,
        );
        $this->assertEquals($result === $expect, true);
    }

    public function testFold()
    {
        $result = HOF::fold($this->getTestArray(),
            function ($carry, $item) {
                return $carry . $item->key() . $item->value();
            });
        $expect = 'one1two2three3four4';
        $this->assertEquals($result === $expect, true);
    }
}

