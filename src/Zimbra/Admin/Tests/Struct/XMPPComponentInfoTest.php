<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for XMPPComponentInfo.
 */
class XMPPComponentInfoTest extends ZimbraStructTestCase
{
    public function testXMPPComponentInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domainName = $this->faker->word;
        $serverName = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xmpp = new XMPPComponentInfo($name, $id, $domainName, $serverName);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($id, $xmpp->getId());
        $this->assertSame($domainName, $xmpp->getDomainName());
        $this->assertSame($serverName, $xmpp->getServerName());

        $xmpp = new XMPPComponentInfo('', '');
        $xmpp->setName($name)
            ->setId($id)
            ->setDomainName($domainName)
            ->setServerName($serverName)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($id, $xmpp->getId());
        $this->assertSame($domainName, $xmpp->getDomainName());
        $this->assertSame($serverName, $xmpp->getServerName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent name="' . $name . '" id="' . $id . '" x-domainName="' . $domainName . '" x-serverName="' . $serverName . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xmpp, 'xml'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($xml, XMPPComponentInfo::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
            'name' => $name,
            'id' => $id,
            'x-domainName' => $domainName,
            'x-serverName' => $serverName,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($xmpp, 'json'));
        $this->assertEquals($xmpp, $this->serializer->deserialize($json, XMPPComponentInfo::class, 'json'));
    }
}
