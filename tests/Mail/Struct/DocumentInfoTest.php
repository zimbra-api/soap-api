<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CommonDocumentInfo;
use Zimbra\Mail\Struct\DocumentInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentInfo.
 */
class DocumentInfoTest extends ZimbraTestCase
{
    public function testDocumentInfo()
    {
        $id = $this->faker->uuid;
        $lockOwnerId = $this->faker->uuid;
        $lockOwnerEmail = $this->faker->email;
        $lockOwnerTimestamp = (string) $this->faker->unixTime;

        $doc = new DocumentInfo(
            $id, $lockOwnerId, $lockOwnerEmail, $lockOwnerTimestamp
        );
        $this->assertSame($lockOwnerId, $doc->getLockOwnerId());
        $this->assertSame($lockOwnerEmail, $doc->getLockOwnerEmail());
        $this->assertSame($lockOwnerTimestamp, $doc->getLockOwnerTimestamp());
        $this->assertTrue($doc instanceof CommonDocumentInfo);
        $doc = new DocumentInfo($id);
        $doc->setLockOwnerId($lockOwnerId)
            ->setLockOwnerEmail($lockOwnerEmail)
            ->setLockOwnerTimestamp($lockOwnerTimestamp);
        $this->assertSame($lockOwnerId, $doc->getLockOwnerId());
        $this->assertSame($lockOwnerEmail, $doc->getLockOwnerEmail());
        $this->assertSame($lockOwnerTimestamp, $doc->getLockOwnerTimestamp());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" loid="$lockOwnerId" loe="$lockOwnerEmail" lt="$lockOwnerTimestamp" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, DocumentInfo::class, 'xml'));
    }
}
