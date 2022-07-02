<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{GetAccountInfoEnvelope, GetAccountInfoBody, GetAccountInfoRequest, GetAccountInfoResponse};
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for GetAccountInfo.
 */
class GetAccountInfoTest extends ZimbraTestCase
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
            <urn:account by="name">$value</urn:account>
        </urn:GetAccountInfoRequest>
        <urn:GetAccountInfoResponse>
            <urn:name>$name</urn:name>
            <urn:attr name="$name">$value</urn:attr>
            <urn:soapURL>$soapURL</urn:soapURL>
            <urn:publicURL>$publicURL</urn:publicURL>
            <urn:changePasswordURL>$changePasswordURL</urn:changePasswordURL>
            <urn:communityURL>$communityURL</urn:communityURL>
            <urn:adminURL>$adminURL</urn:adminURL>
            <urn:boshURL>$boshURL</urn:boshURL>
        </urn:GetAccountInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountInfoEnvelope::class, 'xml'));
    }
}
