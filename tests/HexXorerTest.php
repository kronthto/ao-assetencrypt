<?php

namespace Tests;

use Kronthto\AOEncrypt\HexXorer;
use PHPUnit\Framework\TestCase;

class HexXorerTest extends TestCase
{
    public function testEncryption()
    {
        $xorer = new HexXorer('01');

        $str = \chr(0).'BCAB';

        $iteration1result = $xorer->doXor($str);

        $this->assertSame('0143424043', bin2hex($iteration1result));
        $this->assertNotEquals($str, $iteration1result);

        $iteration2result = $xorer->doXor($iteration1result);

        $this->assertSame($str, $iteration2result);


        $nullXorer = new HexXorer('00000000000');

        $this->assertSame($str, $nullXorer->doXor($str));
    }
}
