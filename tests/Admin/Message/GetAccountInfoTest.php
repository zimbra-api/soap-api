<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAccountInfoBody, GetAccountInfoEnvelope, GetAccountInfoRequest, GetAccountInfoResponse};
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAccountInfo.
 */
class GetAccountInfoTest extends ZimbraTestCase
{
    public function testGetAccountInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $soapURL = $this->faker->word;
        $adminSoapURL = $this->faker->word;
        $publicMailURL = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $attr = new Attr($key, $value);
        $cosAttr = new CosInfoAttr($key, $value, TRUE, TRUE);
        $cos = new CosInfo($name, $id, TRUE, [$cosAttr]);

        $request = new GetAccountInfoRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new GetAccountInfoRequest(new AccountSelector(AccountBy::ID(), ''));
        $request->setAccount($account);
        $this->assertSame($account, $request->getAccount());

        $response = new GetAccountInfoResponse(
            $name, [$attr], $cos, [$soapURL], $adminSoapURL, $publicMailURL
        );
        $this->assertSame($name, $response->getName());
        $this->assertSame([$attr], $response->getAttrList());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame([$soapURL], $response->getSoapURLList());
        $this->assertSame($adminSoapURL, $response->getAdminSoapURL());
        $this->assertSame($publicMailURL, $response->getPublicMailURL());

        $response = new GetAccountInfoResponse('');
        $response->setName($name)
            ->setAttrList([$attr])
            ->setCos($cos)
            ->setSoapURLList([$soapURL])
            ->setAdminSoapURL($adminSoapURL)
            ->setPublicMailURL($publicMailURL);
        $this->assertSame($name, $response->getName());
        $this->assertSame([$attr], $response->getAttrList());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame([$soapURL], $response->getSoapURLList());
        $this->assertSame($adminSoapURL, $response->getAdminSoapURL());
        $this->assertSame($publicMailURL, $response->getPublicMailURL());

        $body = new GetAccountInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAccountInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAccountInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAccountInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountInfoRequest>
            <account by="name">$value</account>
        </urn:GetAccountInfoRequest>
        <urn:GetAccountInfoResponse>
            <name>$name</name>
            <a n="$key">$value</a>
            <cos name="$name" id="$id" isDefaultCos="true">
                <a n="$key" c="true" pd="true">$value</a>
            </cos>
            <soapURL>$soapURL</soapURL>
            <adminSoapURL>$adminSoapURL</adminSoapURL>
            <publicMailURL>$publicMailURL</publicMailURL>
        </urn:GetAccountInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAccountInfoRequest' => [
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAccountInfoResponse' => [
                    'name' => [
                        '_content' => $name,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                        'isDefaultCos' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                                'c' => TRUE,
                                'pd' => TRUE,
                            ],
                        ],
                    ],
                    'soapURL' => [
                        [
                            '_content' => $soapURL,
                        ],
                    ],
                    'adminSoapURL' => [
                        '_content' => $adminSoapURL,
                    ],
                    'publicMailURL' => [
                        '_content' => $publicMailURL,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAccountInfoEnvelope::class, 'json'));
    }
}
