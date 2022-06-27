<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdVersion.
 */
class IdVersionTest extends ZimbraTestCase
{
    public function testIdVersion()
    {
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;

        $doc = new IdVersion(
            $id, $version
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());

        $doc = new IdVersion('');
        $doc->setId($id)
            ->setVersion($version);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" ver="$version" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, IdVersion::class, 'xml'));
    }
}
