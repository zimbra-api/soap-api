<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RenameAccountBody;
use Zimbra\Admin\Message\RenameAccountEnvelope;
use Zimbra\Admin\Message\RenameAccountRequest;
use Zimbra\Admin\Message\RenameAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RenameAccount.
 */
class RenameAccountTest extends ZimbraStructTestCase
{
    public function testRenameAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $newName = $this->faker->word;

        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);

        $request = new RenameAccountRequest(
            $id, $newName
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($newName, $request->getNewName());
        $request = new RenameAccountRequest('', '');
        $request->setId($id)
            ->setNewName($newName);
        $this->assertSame($id, $request->getId());
        $this->assertSame($newName, $request->getNewName());

        $response = new RenameAccountResponse($account);
        $this->assertEquals($account, $response->getAccount());
        $response = new RenameAccountResponse(new AccountInfo('', ''));
        $response->setAccount($account);
        $this->assertEquals($account, $response->getAccount());

        $body = new RenameAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RenameAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameAccountRequest id="$id" newName="$newName" />
        <urn:RenameAccountResponse>
            <account name="$name" id="$id" isExternal="true">
                <a n="$key">$value</a>
            </account>
        </urn:RenameAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RenameAccountRequest' => [
                    'id' => $id,
                    'newName' => $newName,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RenameAccountResponse' => [
                    'account' => [
                        'name' => $name,
                        'id' => $id,
                        'isExternal' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RenameAccountEnvelope::class, 'json'));
    }
}
