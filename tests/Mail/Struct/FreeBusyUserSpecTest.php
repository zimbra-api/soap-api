<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusyUserSpec.
 */
class FreeBusyUserSpecTest extends ZimbraTestCase
{
    public function testFreeBusyUserSpec()
    {
        $folderId = $this->faker->randomNumber;
        $id = $this->faker->uuid;
        $name = $this->faker->email;

        $usr = new FreeBusyUserSpec($folderId, $id, $name);
        $this->assertSame($folderId, $usr->getFolderId());
        $this->assertSame($id, $usr->getId());
        $this->assertSame($name, $usr->getName());

        $usr = new FreeBusyUserSpec();
        $usr->setName($name)
            ->setId($id)
            ->setFolderId($folderId);
        $this->assertSame($folderId, $usr->getFolderId());
        $this->assertSame($id, $usr->getId());
        $this->assertSame($name, $usr->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result l="$folderId" id="$id" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($usr, 'xml'));
        $this->assertEquals($usr, $this->serializer->deserialize($xml, FreeBusyUserSpec::class, 'xml'));
    }
}
