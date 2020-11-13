<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AdminDestroyWaitSetBody;
use Zimbra\Admin\Message\AdminDestroyWaitSetRequest;
use Zimbra\Admin\Message\AdminDestroyWaitSetResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminDestroyWaitSetBody.
 */
class AdminDestroyWaitSetBodyTest extends ZimbraStructTestCase
{
    public function testAdminDestroyWaitSetBody()
    {
        $waitSetId = $this->faker->uuid;
        $request = new AdminDestroyWaitSetRequest(
            $waitSetId
        );
        $response = new AdminDestroyWaitSetResponse(
            $waitSetId
        );

        $body = new AdminDestroyWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AdminDestroyWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AdminDestroyWaitSetRequest waitSet="' . $waitSetId . '" />'
                . '<urn:AdminDestroyWaitSetResponse waitSet="' . $waitSetId . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AdminDestroyWaitSetBody::class, 'xml'));

        $json = json_encode([
            'AdminDestroyWaitSetRequest' => [
                'waitSet' => $waitSetId,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AdminDestroyWaitSetResponse' => [
                'waitSet' => $waitSetId,
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AdminDestroyWaitSetBody::class, 'json'));
    }
}
