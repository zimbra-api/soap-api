<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap\Header;

use Zimbra\Soap\Header\SessionInfo;
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
<session proxy="true" id="$id" seq="$sequence">$value</session>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, SessionInfo::class, 'xml'));

        $json = json_encode([
            'proxy' => TRUE,
            'id' => $id,
            'seq' => $sequence,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, SessionInfo::class, 'json'));
    }
}
