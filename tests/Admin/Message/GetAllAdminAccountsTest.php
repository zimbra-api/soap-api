<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllAdminAccountsBody;
use Zimbra\Admin\Message\GetAllAdminAccountsEnvelope;
use Zimbra\Admin\Message\GetAllAdminAccountsRequest;
use Zimbra\Admin\Message\GetAllAdminAccountsResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GetAllAdminAccountsTest.
 */
class GetAllAdminAccountsTest extends ZimbraStructTestCase
{
    public function testGetAllAdminAccounts()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new GetAllAdminAccountsRequest(FALSE);
        $this->assertFalse($request->isApplyCos());
        $request->setApplyCos(TRUE);
        $this->assertTrue($request->isApplyCos());

        $response = new GetAllAdminAccountsResponse([$account]);
        $this->assertSame([$account], $response->getAccountList());
        $response = new GetAllAdminAccountsResponse();
        $response->setAccountList([$account])
            ->addAccount($account);
        $this->assertSame([$account, $account], $response->getAccountList());
        $response->setAccountList([$account]);

        $body = new GetAllAdminAccountsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllAdminAccountsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllAdminAccountsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllAdminAccountsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAdminAccountsRequest applyCos="true" />
        <urn:GetAllAdminAccountsResponse>
            <account name="$name" id="$id" isExternal="true">
                <a n="$key">$value</a>
            </account>
        </urn:GetAllAdminAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAdminAccountsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllAdminAccountsRequest' => [
                    'applyCos' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllAdminAccountsResponse' => [
                    'account' => [
                        [
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
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllAdminAccountsEnvelope::class, 'json'));
    }
}
