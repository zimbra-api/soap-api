<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeployZimletBody;
use Zimbra\Admin\Message\DeployZimletEnvelope;
use Zimbra\Admin\Message\DeployZimletRequest;
use Zimbra\Admin\Message\DeployZimletResponse;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Admin\Struct\ZimletDeploymentStatus;
use Zimbra\Enum\ZimletDeployAction;
use Zimbra\Enum\ZimletDeployStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeployZimlet.
 */
class DeployZimletTest extends ZimbraStructTestCase
{
    public function testDeployZimlet()
    {
        $aid = $this->faker->uuid;
        $server = $this->faker->word;
        $error = $this->faker->word;

        $content = new AttachmentIdAttrib($aid);
        $progress = new ZimletDeploymentStatus($server, ZimletDeployStatus::SUCCEEDED(), $error);

        $request = new DeployZimletRequest(ZimletDeployAction::DEPLOY_ALL(), $content, FALSE, FALSE);
        $this->assertEquals(ZimletDeployAction::DEPLOY_ALL(), $request->getAction());
        $this->assertSame($content, $request->getContent());
        $this->assertFalse($request->getFlushCache());
        $this->assertFalse($request->getSynchronous());

        $request = new DeployZimletRequest(ZimletDeployAction::DEPLOY_ALL(), new AttachmentIdAttrib(''));
        $request->setAction(ZimletDeployAction::DEPLOY_LOCAL())
            ->setContent($content)
            ->setFlushCache(TRUE)
            ->setSynchronous(TRUE);
        $this->assertEquals(ZimletDeployAction::DEPLOY_LOCAL(), $request->getAction());
        $this->assertSame($content, $request->getContent());
        $this->assertTrue($request->getFlushCache());
        $this->assertTrue($request->getSynchronous());

        $response = new DeployZimletResponse([$progress]);
        $this->assertSame([$progress], $response->getProgresses());
        $response = new DeployZimletResponse();
        $response->setProgresses([$progress])
            ->addProgress($progress);
        $this->assertSame([$progress, $progress], $response->getProgresses());
        $response->setProgresses([$progress]);

        $body = new DeployZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeployZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeployZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeployZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeployZimletRequest action="deployLocal" flush="true" synchronous="true">
            <content aid="$aid" />
        </urn:DeployZimletRequest>
        <urn:DeployZimletResponse>
            <progress server="$server" status="succeeded" error="$error" />
        </urn:DeployZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeployZimletEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeployZimletRequest' => [
                    'action' => 'deployLocal',
                    'flush' => TRUE,
                    'synchronous' => TRUE,
                    'content' => [
                        'aid' => $aid,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeployZimletResponse' => [
                    'progress' => [
                        [
                            'server' => $server,
                            'status' => 'succeeded',
                            'error' => $error,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeployZimletEnvelope::class, 'json'));
    }
}
