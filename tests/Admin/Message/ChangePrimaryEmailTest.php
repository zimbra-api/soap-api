<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ChangePrimaryEmailBody;
use Zimbra\Admin\Message\ChangePrimaryEmailEnvelope;
use Zimbra\Admin\Message\ChangePrimaryEmailRequest;
use Zimbra\Admin\Message\ChangePrimaryEmailResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ChangePrimaryEmail.
 */
class ChangePrimaryEmailTest extends ZimbraTestCase
{
    public function testChangePrimaryEmail()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->email;
        $newName = $this->faker->email;

        $account = new AccountSelector(AccountBy::NAME, $name);
        $request = new ChangePrimaryEmailRequest(
            $account, $newName
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($newName, $request->getNewName());

        $request = new ChangePrimaryEmailRequest(
            new AccountSelector()
        );
        $request->setAccount($account)
            ->setNewName($newName);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($newName, $request->getNewName());

        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);
        $response = new ChangePrimaryEmailResponse($account);
        $this->assertSame($account, $response->getAccount());
        $response = new ChangePrimaryEmailResponse();
        $response->setAccount($account);
        $this->assertSame($account, $response->getAccount());

        $body = new ChangePrimaryEmailBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ChangePrimaryEmailBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ChangePrimaryEmailEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ChangePrimaryEmailEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $by = AccountBy::NAME->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ChangePrimaryEmailRequest>
            <urn:account by="$by">$name</urn:account>
            <urn:newName>$newName</urn:newName>
        </urn:ChangePrimaryEmailRequest>
        <urn:ChangePrimaryEmailResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:ChangePrimaryEmailResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePrimaryEmailEnvelope::class, 'xml'));
    }
}
