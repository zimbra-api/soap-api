<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\Attr;

/**
 * Testcase class for GalContactInfo.
 */
class GalContactInfoTest extends ZimbraTestCase
{
    public function testGalContactInfo()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cn = new StubGalContactInfo($id, [new Attr($key, $value)]);
        $this->assertSame($id, $cn->getId());

        $cn = new StubGalContactInfo('', [new Attr($key, $value)]);
        $cn->setId($id);
        $this->assertSame($id, $cn->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cn, 'xml'));
        $this->assertEquals($cn, $this->serializer->deserialize($xml, StubGalContactInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubGalContactInfo extends GalContactInfo
{
}
