<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ExceptIdInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExceptIdInfo.
 */
class ExceptIdInfoTest extends ZimbraTestCase
{
    public function testExceptIdInfo()
    {
        $id = $this->faker->uuid;
        $recurrenceId = $this->faker->uuid;

        $except = new ExceptIdInfo(
            $recurrenceId, $id
        );
        $this->assertSame($id, $except->getId());
        $this->assertSame($recurrenceId, $except->getRecurrenceId());

        $except = new ExceptIdInfo();
        $except->setId($id)
            ->setRecurrenceId($recurrenceId);
        $this->assertSame($id, $except->getId());
        $this->assertSame($recurrenceId, $except->getRecurrenceId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result recurId="$recurrenceId" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($except, 'xml'));
        $this->assertEquals($except, $this->serializer->deserialize($xml, ExceptIdInfo::class, 'xml'));
    }
}
