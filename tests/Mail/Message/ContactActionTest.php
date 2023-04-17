<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ContactActionOp;

use Zimbra\Mail\Message\ContactActionEnvelope;
use Zimbra\Mail\Message\ContactActionBody;
use Zimbra\Mail\Message\ContactActionRequest;
use Zimbra\Mail\Message\ContactActionResponse;

use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Mail\Struct\FolderActionResult;
use Zimbra\Mail\Struct\NewContactAttr;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactAction.
 */
class ContactActionTest extends ZimbraTestCase
{
    public function testContactAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->randomElement(ContactActionOp::cases())->value;
        $name = $this->faker->word;
        $attachId = $this->faker->uuid;
        $cid = $this->faker->numberBetween(1, 100);
        $part = $this->faker->word;
        $value = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->text;

        $action = new ContactActionSelector($operation, $id, [new NewContactAttr(
            $name, $attachId, $cid, $part, $value
        )]);
        $request = new ContactActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new ContactActionRequest(new ContactActionSelector());
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $response = new ContactActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new ContactActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new ContactActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ContactActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ContactActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ContactActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ContactActionRequest>
            <urn:action id="$id" op="$operation">
                <urn:attr n="$name" aid="$attachId" id="$cid" part="$part">$value</urn:attr>
            </urn:action>
        </urn:ContactActionRequest>
        <urn:ContactActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
        </urn:ContactActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ContactActionEnvelope::class, 'xml'));
    }
}
