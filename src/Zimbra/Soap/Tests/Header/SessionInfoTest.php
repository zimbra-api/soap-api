<?php

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Soap\Header\SessionInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SessionInfo.
 */
class SessionInfoTest extends ZimbraStructTestCase
{
    public function testHeaderSessionInfo()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $sequence = mt_rand(1, 100);

        $info = new SessionInfo(false, $id, $sequence, $value);
        $this->assertFalse($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());

        $info = new SessionInfo();
        $info->setSessionProxied(true)
             ->setSessionId($id)
             ->setSequenceNum($sequence)
             ->setValue($value);
        $this->assertTrue($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<session proxy="true" id="' . $id . '" seq="' . $sequence . '">' . $value . '</session>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));

        $info = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header\SessionInfo', 'xml');
        $this->assertTrue($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());
    }
}
