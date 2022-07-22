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
    public function testGetEffectiveFolderPerms()
    {
        $folderId = $this->faker->uuid;
        $effectivePermissions = $this->faker->word;

        $folder = new FolderSpec($folderId);
        $request = new GetEffectiveFolderPermsRequest($folder);
        $this->assertSame($folder, $request->getFolder());
        $request = new GetEffectiveFolderPermsRequest(new FolderSpec());
        $request->setFolder($folder);
        $this->assertSame($folder, $request->getFolder());

        $folder = new Rights($effectivePermissions);
        $response = new GetEffectiveFolderPermsResponse($folder);
        $this->assertSame($folder, $response->getFolder());
        $response = new GetEffectiveFolderPermsResponse();
        $response->setFolder($folder);
        $this->assertSame($folder, $response->getFolder());

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
            <urn:folder l="$folderId" />
        </urn:GetEffectiveFolderPermsRequest>
        <urn:GetEffectiveFolderPermsResponse>
            <urn:folder perm="$effectivePermissions" />
        </urn:GetEffectiveFolderPermsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetEffectiveFolderPermsEnvelope::class, 'xml'));
    }
}
