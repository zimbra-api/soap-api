<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetEffectiveFolderPermsEnvelope;
use Zimbra\Mail\Message\GetEffectiveFolderPermsBody;
use Zimbra\Mail\Message\GetEffectiveFolderPermsRequest;
use Zimbra\Mail\Message\GetEffectiveFolderPermsResponse;

use Zimbra\Mail\Struct\FolderSpec;
use Zimbra\Mail\Struct\Rights;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetEffectiveFolderPerms.
 */
class GetEffectiveFolderPermsTest extends ZimbraTestCase
{
    public function testFolder()
    {
        $effectivePermissions = $this->faker->word;
        $folder = $this->faker->uuid;

        $spec = new FolderSpec($folder);
        $request = new GetEffectiveFolderPermsRequest($spec);
        $this->assertSame($spec, $request->getFolder());
        $request = new GetEffectiveFolderPermsRequest(new FolderSpec(''));
        $request->setFolder($spec);
        $this->assertSame($spec, $request->getFolder());

        $rights = new Rights($effectivePermissions);
        $response = new GetEffectiveFolderPermsResponse($rights);
        $this->assertSame($rights, $response->getFolder());
        $response = new GetEffectiveFolderPermsResponse(new Rights(''));
        $response->setFolder($rights);
        $this->assertSame($rights, $response->getFolder());

        $body = new GetEffectiveFolderPermsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetEffectiveFolderPermsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetEffectiveFolderPermsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetEffectiveFolderPermsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetEffectiveFolderPermsRequest>
            <folder l="$folder" />
        </urn:GetEffectiveFolderPermsRequest>
        <urn:GetEffectiveFolderPermsResponse>
            <folder perm="$effectivePermissions" />
        </urn:GetEffectiveFolderPermsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetEffectiveFolderPermsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetEffectiveFolderPermsRequest' => [
                    'folder' => [
                        'l' => $folder,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetEffectiveFolderPermsResponse' => [
                    'folder' => [
                        'perm' => $effectivePermissions,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetEffectiveFolderPermsEnvelope::class, 'json'));
    }
}
