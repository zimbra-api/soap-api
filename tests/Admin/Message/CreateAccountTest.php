<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateAccountBody;
use Zimbra\Admin\Message\CreateAccountEnvelope;
use Zimbra\Admin\Message\CreateAccountRequest;
use Zimbra\Admin\Message\CreateAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateAccount.
 */
class CreateAccountTest extends ZimbraTestCase
{
    public function testCreateAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new CreateAccountRequest(
            $name, $password, [$attr]
        );
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());
        $request = new CreateAccountRequest('', '');
        $request->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());

        $response = new CreateAccountResponse($account);
        $this->assertEquals($account, $response->getAccount());
        $response = new CreateAccountResponse(new AccountInfo('', ''));
        $response->setAccount($account);
        $this->assertEquals($account, $response->getAccount());

        $body = new CreateAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateAccountRequest name="$name" password="$password">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateAccountRequest>
        <urn:CreateAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:CreateAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAccountEnvelope::class, 'xml'));
    }
}
