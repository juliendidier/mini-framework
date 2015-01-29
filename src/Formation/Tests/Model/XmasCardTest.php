<?php

namespace Formation\Tests\Model;

use Formation\Model\Ong;
use Formation\Model\XmasCard;

class XmasCardTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFormat()
    {
        $ong = new Ong('UNICEF', 'http://unicef.fr', 10);
        $xmasCard = new XmasCard();
        $xmasCard->setFormat('15x15');
        $xmasCard->setOng($ong);

        $this->assertEquals('15x15', $xmasCard->getFormat());
        $this->assertInstanceOf('Formation\Model\Ong', $xmasCard->getOng());
        $this->assertSame($ong, $xmasCard->getOng());
    }
}
