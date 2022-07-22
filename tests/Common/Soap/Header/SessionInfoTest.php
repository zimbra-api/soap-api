<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Header;

use Zimbra\Common\Soap\Header\SessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SessionInfo.
 */
class SessionInfoTest extends ZimbraTestCase
{
    public function testHeaderSessionInfo()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $sequence = mt_rand(1, 100);

        $info = new SessionInfo(FALSE, $id, $sequence, $value);
        $this->assertFalse($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());

        $info = new SessionInfo();
        $info->setSessionProxied(TRUE)
             ->setSessionId($id)
             ->setSequenceNum($sequence)
             ->setValue($value);
        $this->assertTrue($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result proxy="true" id="$id" seq="$sequence">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, SessionInfo::class, 'xml'));
    }
}
