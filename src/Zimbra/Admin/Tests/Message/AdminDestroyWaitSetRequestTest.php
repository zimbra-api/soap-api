<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AdminDestroyWaitSetRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminDestroyWaitSetRequest.
 */
class AdminDestroyWaitSetRequestTest extends ZimbraStructTestCase
{
    public function testAdminDestroyWaitSetRequest()
    {
        $waitSetId = $this->faker->uuid;
        $res = new AdminDestroyWaitSetRequest(
            $waitSetId
        );
        $this->assertSame($waitSetId, $res->getWaitSetId());

        $res = new AdminDestroyWaitSetRequest('');
        $res->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $res->getWaitSetId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminDestroyWaitSetRequest waitSet="' . $waitSetId . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AdminDestroyWaitSetRequest::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AdminDestroyWaitSetRequest::class, 'json'));
    }
}
