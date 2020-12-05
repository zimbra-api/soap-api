<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{GetAccountBody, GetAccountEnvelope, GetAccountRequest, GetAccountResponse};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAccount.
 */
class GetAccountTest extends ZimbraStructTestCase
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

        $attr = new Attr($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $accountInfo = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new GetAccountRequest($account, FALSE, $attrs);
        $this->assertSame($account, $request->getAccount());
        $this->assertFalse($request->isApplyCos());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetAccountRequest(new AccountSelector(AccountBy::ID(), ''));
        $request->setAccount($account)
            ->setApplyCos(TRUE)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($account, $request->getAccount());
        $this->assertTrue($request->isApplyCos());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetAccountResponse(
            $accountInfo
        );
        $this->assertSame($accountInfo, $response->getAccount());
        $response = new GetAccountResponse(new AccountInfo('', ''));
        $response->setAccount($accountInfo);
        $this->assertSame($accountInfo, $response->getAccount());

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
        <urn:GetAccountRequest applyCos="true" attrs="$attrs">
            <account by="name">$value</account>
        </urn:GetAccountRequest>
        <urn:GetAccountResponse>
            <account name="$name" id="$id" isExternal="true">
                <a n="$key">$value</a>
            </account>
        </urn:GetAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAccountRequest' => [
                    'applyCos' => TRUE,
                    'attrs' => $attrs,
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAccountResponse' => [
                    'account' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'isExternal' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAccountEnvelope::class, 'json'));
    }
}
