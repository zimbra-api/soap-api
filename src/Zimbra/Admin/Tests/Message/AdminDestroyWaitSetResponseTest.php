<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminDestroyWaitSetResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminDestroyWaitSetResponse.
 */
class AdminDestroyWaitSetResponseTest extends ZimbraStructTestCase
{
    public function testAdminDestroyWaitSetResponse()
    {
        $waitSetId = $this->faker->uuid;
        $res = new AdminDestroyWaitSetResponse(
            $waitSetId
        );
        $this->assertSame($waitSetId, $res->getWaitSetId());

        $res = new AdminDestroyWaitSetResponse('');
        $res->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $res->getWaitSetId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminDestroyWaitSetResponse waitSet="' . $waitSetId . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AdminDestroyWaitSetResponse::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AdminDestroyWaitSetResponse::class, 'json'));
    }
}
