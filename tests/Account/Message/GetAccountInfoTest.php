<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{GetAccountInfoEnvelope, GetAccountInfoBody, GetAccountInfoRequest, GetAccountInfoResponse};
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\NamedValue;
use Zimbra\Tests\Struct\ZimbraStructTestCase;
/**
 * Testcase class for GetAccountInfo.
 */
class GetAccountInfoTest extends ZimbraStructTestCase
{
    public function testGetAccountInfo()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $soapURL = $this->faker->url;
        $publicURL = $this->faker->url;
        $changePasswordURL = $this->faker->url;
        $communityURL = $this->faker->url;
        $adminURL = $this->faker->url;
        $boshURL = $this->faker->url;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $request = new GetAccountInfoRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new GetAccountInfoRequest(new AccountSelector(AccountBy::NAME(), ''));
        $request->setAccount($account);
        $this->assertSame($account, $request->getAccount());

        $attr = new NamedValue($name, $value);
        $response = new GetAccountInfoResponse(
            $name, [$attr], $soapURL, $publicURL, $changePasswordURL, $communityURL, $adminURL, $boshURL
        );
        $this->assertSame($name, $response->getName());
        $this->assertSame([$attr], $response->getAttrs());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($communityURL, $response->getCommunityURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
        $response = new GetAccountInfoResponse('');
        $response->setName($name)
            ->setAttrs([$attr])
            ->addAttr($attr)
            ->setSoapURL($soapURL)
            ->setPublicURL($publicURL)
            ->setChangePasswordURL($changePasswordURL)
            ->setCommunityURL($communityURL)
            ->setAdminURL($adminURL)
            ->setBoshURL($boshURL);
        $this->assertSame($name, $response->getName());
        $this->assertSame([$attr, $attr], $response->getAttrs());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($communityURL, $response->getCommunityURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
        $response->setAttrs([$attr]);

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAccountInfoRequest>
            <account by="name">$value</account>
        </urn:GetAccountInfoRequest>
        <urn:GetAccountInfoResponse>
            <name>$name</name>
            <attr name="$name">$value</attr>
            <soapURL>$soapURL</soapURL>
            <publicURL>$publicURL</publicURL>
            <changePasswordURL>$changePasswordURL</changePasswordURL>
            <communityURL>$communityURL</communityURL>
            <adminURL>$adminURL</adminURL>
            <boshURL>$boshURL</boshURL>
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
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetAccountInfoResponse' => [
                    'name' => [
                        '_content' => $name,
                    ],
                    'attr' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                    'soapURL' => [
                        '_content' => $soapURL,
                    ],
                    'publicURL' => [
                        '_content' => $publicURL,
                    ],
                    'changePasswordURL' => [
                        '_content' => $changePasswordURL,
                    ],
                    'communityURL' => [
                        '_content' => $communityURL,
                    ],
                    'adminURL' => [
                        '_content' => $adminURL,
                    ],
                    'boshURL' => [
                        '_content' => $boshURL,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAccountInfoEnvelope::class, 'json'));
    }
}
