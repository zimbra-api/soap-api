<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RenameAccountBody;
use Zimbra\Admin\Message\RenameAccountEnvelope;
use Zimbra\Admin\Message\RenameAccountRequest;
use Zimbra\Admin\Message\RenameAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RenameAccount.
 */
class RenameAccountTest extends ZimbraTestCase
{
    public function testRenameAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new RenameAccountRequest(
            $id, $name
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());
        $request = new RenameAccountRequest();
        $request->setId($id)
            ->setNewName($name);
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());

        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);
        $response = new RenameAccountResponse($account);
        $this->assertSame($account, $response->getAccount());
        $response = new RenameAccountResponse();
        $response->setAccount($account);
        $this->assertSame($account, $response->getAccount());

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
        <urn:RenameAccountRequest id="$id" newName="$name" />
        <urn:RenameAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:RenameAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameAccountEnvelope::class, 'xml'));
    }
}
