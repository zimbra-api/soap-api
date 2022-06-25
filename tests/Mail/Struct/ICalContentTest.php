<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ICalContent;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ICalContent.
 */
class ICalContentTest extends ZimbraTestCase
{
    public function testICalContent()
    {
        $id = $this->faker->uuid;
        $ical = $this->faker->text;

        $content = new ICalContent(
            $id, $ical
        );
        $this->assertSame($id, $content->getId());
        $this->assertSame($ical, $content->getIcal());

        $content = new ICalContent('');
        $content->setId($id)
            ->setIcal($ical);
        $this->assertSame($id, $content->getId());
        $this->assertSame($ical, $content->getIcal());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id">$ical</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, ICalContent::class, 'xml'));
    }
}
