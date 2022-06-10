<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{ActionGrantRight, ContactActionOp, GranteeType, Type};

use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\FolderActionResult;
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Mail\Message\FolderActionEnvelope;
use Zimbra\Mail\Message\FolderActionBody;
use Zimbra\Mail\Message\FolderActionRequest;
use Zimbra\Mail\Message\FolderActionResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FolderAction.
 */
class FolderActionTest extends ZimbraTestCase
{
    public function testFolderAction()
    {
        $operation = $this->faker->randomElement(ContactActionOp::values())->getValue();
        $ids = $this->faker->uuid;

        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $url = $this->faker->url;
        $zimbraId = $this->faker->uuid;
        $grantType = GranteeType::USR();
        $view = $this->faker->word;
        $numDays = $this->faker->randomNumber;

        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $rights = implode(',', [ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;
        $lifetime = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
        );
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );
        $action = new FolderActionSelector(
            $operation, $ids, TRUE, $url, TRUE, $zimbraId, $grantType, $view, $grant, [$grant], $retentionPolicy, $numDays
        );
        $result = new FolderActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds, $zimbraId, $displayName, $accessKey
        );

        $request = new FolderActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new FolderActionRequest(new FolderActionSelector($operation, $ids));
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $response = new FolderActionResponse($result);
        $this->assertSame($result, $response->getAction());
        $response = new FolderActionResponse(new FolderActionResult('', '', '', ''));
        $response->setAction($result);
        $this->assertSame($result, $response->getAction());

        $body = new FolderActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FolderActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FolderActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FolderActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:FolderActionRequest>
            <action id="$ids" op="$operation" recursive="true" url="$url" excludeFreeBusy="true" zid="$zimbraId" gt="usr" view="$view" numDays="$numDays">
                <grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
                <acl>
                    <grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
                </acl>
                <retentionPolicy>
                    <keep>
                        <policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </keep>
                    <purge>
                        <policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </purge>
                </retentionPolicy>
            </action>
        </urn:FolderActionRequest>
        <urn:FolderActionResponse>
            <action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" zid="$zimbraId" d="$displayName" key="$accessKey" />
        </urn:FolderActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FolderActionEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'FolderActionRequest' => [
                    'action' => [
                        'id' => $ids,
                        'op' => $operation,
                        'recursive' => TRUE,
                        'url' => $url,
                        'excludeFreeBusy' => TRUE,
                        'zid' => $zimbraId,
                        'gt' => 'usr',
                        'view' => $view,
                        'numDays' => $numDays,
                        'grant' => [
                            'perm' => $rights,
                            'gt' => 'usr',
                            'zid' => $zimbraId,
                            'd' => $displayName,
                            'args' => $args,
                            'pw' => $password,
                            'key' => $accessKey,
                        ],
                        'acl' => [
                            'grant' => [
                                [
                                    'perm' => $rights,
                                    'gt' => 'usr',
                                    'zid' => $zimbraId,
                                    'd' => $displayName,
                                    'args' => $args,
                                    'pw' => $password,
                                    'key' => $accessKey,
                                ],
                            ],
                        ],
                        'retentionPolicy' => [
                            'keep' => [
                                'policy' => [
                                    [
                                        'type' => 'system',
                                        'id' => $id,
                                        'name' => $name,
                                        'lifetime' => $lifetime,
                                    ],
                                ],
                            ],
                            'purge' => [
                                'policy' => [
                                    [
                                        'type' => 'user',
                                        'id' => $id,
                                        'name' => $name,
                                        'lifetime' => $lifetime,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'FolderActionResponse' => [
                    'action' => [
                        'id' => $id,
                        'op' => $operation,
                        'nei' => $nonExistentIds,
                        'nci' => $newlyCreatedIds,
                        'zid' => $zimbraId,
                        'd' => $displayName,
                        'key' => $accessKey,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, FolderActionEnvelope::class, 'json'));
    }
}
