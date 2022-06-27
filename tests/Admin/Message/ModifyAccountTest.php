<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyAccountBody;
use Zimbra\Admin\Message\ModifyAccountEnvelope;
use Zimbra\Admin\Message\ModifyAccountRequest;
use Zimbra\Admin\Message\ModifyAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyAccount.
 */
class ModifyAccountTest extends ZimbraTestCase
{
    public function testModifyAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);

        $request = new ModifyAccountRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyAccountRequest('');
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $response = new ModifyAccountResponse($account);
        $this->assertEquals($account, $response->getAccount());
        $response = new ModifyAccountResponse(new AccountInfo('', ''));
        $response->setAccount($account);
        $this->assertEquals($account, $response->getAccount());

        $body = new ModifyAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAccountRequest id="$id">
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyAccountRequest>
        <urn:ModifyAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:ModifyAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyAccountEnvelope::class, 'xml'));
    }
}
