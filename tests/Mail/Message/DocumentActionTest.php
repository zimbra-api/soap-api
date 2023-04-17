<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{ActionGrantRight, DocumentActionOp, GranteeType};

use Zimbra\Mail\Message\DocumentActionEnvelope;
use Zimbra\Mail\Message\DocumentActionBody;
use Zimbra\Mail\Message\DocumentActionRequest;
use Zimbra\Mail\Message\DocumentActionResponse;

use Zimbra\Mail\Struct\DocumentActionSelector;
use Zimbra\Mail\Struct\DocumentActionGrant;
use Zimbra\Mail\Struct\DocumentActionResult;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentAction.
 */
class DocumentActionTest extends ZimbraTestCase
{
    public function testDocumentAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->randomElement(DocumentActionOp::cases())->value;

        $zimbraId = $this->faker->uuid;
        $grantType = GranteeType::USR;

        $rights = implode(',', [ActionGrantRight::READ->value, ActionGrantRight::WRITE->value]);
        $expiry = $this->faker->randomNumber;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $grant = new DocumentActionGrant(
            $rights, $grantType, $expiry, $zimbraId, $displayName, $args, $password, $accessKey
        );

        $action = new DocumentActionSelector(
            $operation, $id, $zimbraId, $grant
        );

        $request = new DocumentActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new DocumentActionRequest(new DocumentActionSelector($operation, $id));
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new DocumentActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );
        $response = new DocumentActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new DocumentActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new DocumentActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DocumentActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DocumentActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DocumentActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DocumentActionRequest>
            <urn:action id="$id" op="$operation" zid="$zimbraId">
                <urn:grant perm="$rights" gt="usr" expiry="$expiry" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
            </urn:action>
        </urn:DocumentActionRequest>
        <urn:DocumentActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
        </urn:DocumentActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DocumentActionEnvelope::class, 'xml'));
    }
}
