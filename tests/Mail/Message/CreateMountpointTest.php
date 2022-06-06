<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ViewType;

use Zimbra\Mail\Message\CreateMountpointEnvelope;
use Zimbra\Mail\Message\CreateMountpointBody;
use Zimbra\Mail\Message\CreateMountpointRequest;
use Zimbra\Mail\Message\CreateMountpointResponse;

use Zimbra\Mail\Struct\NewMountpointSpec;
use Zimbra\Mail\Struct\Mountpoint;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateMountpoint.
 */
class CreateMountpointTest extends ZimbraTestCase
{
    public function testCreateMountpoint()
    {
        $name = $this->faker->word;
        $folderId = $this->faker->uuid;
        $defaultView = ViewType::CONVERSATION();
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $ownerId = $this->faker->uuid;
        $ownerName = $this->faker->word;
        $remoteId = $this->faker->numberBetween(0, 99);
        $path = $this->faker->word;

        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerAccountId = $this->faker->uuid;
        $remoteFolderId = $this->faker->randomNumber;
        $remoteUuid = $this->faker->uuid;
        $remoteFolderName = $this->faker->word;

        $folder = new NewMountpointSpec(
            $name,
            $folderId,
            $defaultView,
            $flags,
            $color,
            $rgb,
            $url,
            TRUE,
            TRUE,
            $ownerId,
            $ownerName,
            $remoteId,
            $path
        );
        $request = new CreateMountpointRequest($folder);
        $this->assertSame($folder, $request->getFolder());
        $request = new CreateMountpointRequest(new NewMountpointSpec('', ''));
        $request->setFolder($folder);
        $this->assertSame($folder, $request->getFolder());

        $link = new Mountpoint(
            $id,
            $uuid,
            $ownerEmail,
            $ownerAccountId,
            $remoteFolderId,
            $remoteUuid,
            $remoteFolderName,
            TRUE,
            TRUE
        );
        $response = new CreateMountpointResponse($link);
        $this->assertSame($link, $response->getMount());
        $response = new CreateMountpointResponse(new Mountpoint('', ''));
        $response->setMount($link);
        $this->assertSame($link, $response->getMount());

        $body = new CreateMountpointBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateMountpointBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateMountpointEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateMountpointEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateMountpointRequest>
            <link name="$name" view="conversation" f="$flags" color="$color" rgb="$rgb" url="$url" l="$folderId" fie="true" reminder="true" zid="$ownerId" owner="$ownerName" rid="$remoteId" path="$path" />
        </urn:CreateMountpointRequest>
        <urn:CreateMountpointResponse>
            <link id="$id" uuid="$uuid" owner="$ownerEmail" zid="$ownerAccountId" rid="$remoteFolderId" ruuid="$remoteUuid" oname="$remoteFolderName" reminder="true" broken="true" />
        </urn:CreateMountpointResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateMountpointEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateMountpointRequest' => [
                    'link' => [
                        'name' => $name,
                        'view' => 'conversation',
                        'f' => $flags,
                        'rgb' => $rgb,
                        'color' => $color,
                        'url' => $url,
                        'l' => $folderId,
                        'fie' => TRUE,
                        'reminder' => TRUE,
                        'zid' => $ownerId,
                        'owner' => $ownerName,
                        'rid' => $remoteId,
                        'path' => $path,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'CreateMountpointResponse' => [
                    'link' => [
                        'id' => $id,
                        'uuid' => $uuid,
                        'owner' => $ownerEmail,
                        'zid' => $ownerAccountId,
                        'rid' => $remoteFolderId,
                        'ruuid' => $remoteUuid,
                        'oname' => $remoteFolderName,
                        'reminder' => TRUE,
                        'broken' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateMountpointEnvelope::class, 'json'));
    }
}
