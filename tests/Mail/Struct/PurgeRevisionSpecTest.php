<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\PurgeRevisionSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PurgeRevisionSpec.
 */
class PurgeRevisionSpecTest extends ZimbraTestCase
{
    public function testPurgeRevisionSpec()
    {
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;

        $revision = new PurgeRevisionSpec(
            $id, $version, FALSE
        );
        $this->assertSame($id, $revision->getId());
        $this->assertSame($version, $revision->getVersion());
        $this->assertFalse($revision->getIncludeOlderRevisions());

        $revision = new PurgeRevisionSpec();
        $revision->setId($id)
            ->setVersion($version)
            ->setIncludeOlderRevisions(TRUE);
        $this->assertSame($id, $revision->getId());
        $this->assertSame($version, $revision->getVersion());
        $this->assertTrue($revision->getIncludeOlderRevisions());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" ver="$version" includeOlderRevisions="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($revision, 'xml'));
        $this->assertEquals($revision, $this->serializer->deserialize($xml, PurgeRevisionSpec::class, 'xml'));
    }
}
