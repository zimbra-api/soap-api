<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\GetCalendarItemRequestBase;
use Zimbra\Soap\EnvelopeInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCalendarItemRequestBase.
 */
class GetCalendarItemRequestBaseTest extends ZimbraTestCase
{
    public function testGetCalendarItemRequestBase()
    {
        $uid = $this->faker->uuid;
        $id = $this->faker->uuid;

        $request = new GetCalendarRequest(FALSE, FALSE, FALSE, $uid, $id);
        $this->assertFalse($request->getSync());
        $this->assertFalse($request->getIncludeContent());
        $this->assertFalse($request->getIncludeInvites());
        $this->assertSame($uid, $request->getUid());
        $this->assertSame($id, $request->getId());

        $request = new GetCalendarRequest();
        $request->setUid($uid)
            ->setId($id)
            ->setSync(TRUE)
            ->setIncludeContent(TRUE)
            ->setIncludeInvites(TRUE);
        $this->assertTrue($request->getSync());
        $this->assertTrue($request->getIncludeContent());
        $this->assertTrue($request->getIncludeInvites());
        $this->assertSame($uid, $request->getUid());
        $this->assertSame($id, $request->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result sync="true" includeContent="true" includeInvites="true" uid="$uid" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($request, 'xml'));
        $this->assertEquals($request, $this->serializer->deserialize($xml, GetCalendarRequest::class, 'xml'));
    }
}

class GetCalendarRequest extends GetCalendarItemRequestBase
{
    protected function envelopeInit(): EnvelopeInterface
    {
    }
}
