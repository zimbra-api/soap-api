<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAccountBody, GetAccountEnvelope, GetAccountRequest, GetAccountResponse};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAccount.
 */
class GetAccountTest extends ZimbraTestCase
{
    public function testGetAccount()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $account = new AccountSelector(AccountBy::NAME, $value);
        $request = new GetAccountRequest($account, FALSE, FALSE, $attrs);
        $this->assertSame($account, $request->getAccount());
        $this->assertFalse($request->isApplyCos());
        $this->assertFalse($request->isEffectiveQuota());
        $this->assertSame($attrs, $request->getAttrs());
        $request = new GetAccountRequest(new AccountSelector());
        $request->setAccount($account)
            ->setApplyCos(TRUE)
            ->setEffectiveQuota(TRUE)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($account, $request->getAccount());
        $this->assertTrue($request->isApplyCos());
        $this->assertTrue($request->isEffectiveQuota());
        $this->assertSame($attrs, $request->getAttrs());

        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);
        $response = new GetAccountResponse(
            $account
        );
        $this->assertSame($account, $response->getAccount());
        $response = new GetAccountResponse();
        $response->setAccount($account);
        $this->assertSame($account, $response->getAccount());

        $body = new GetAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountRequest applyCos="true" effectiveQuota="true" attrs="$attrs">
            <urn:account by="name">$value</urn:account>
        </urn:GetAccountRequest>
        <urn:GetAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:GetAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountEnvelope::class, 'xml'));
    }
}
