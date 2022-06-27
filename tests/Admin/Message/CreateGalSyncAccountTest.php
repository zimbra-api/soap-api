<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateGalSyncAccountBody;
use Zimbra\Admin\Message\CreateGalSyncAccountEnvelope;
use Zimbra\Admin\Message\CreateGalSyncAccountRequest;
use Zimbra\Admin\Message\CreateGalSyncAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\GalMode;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateGalSyncAccount.
 */
class CreateGalSyncAccountTest extends ZimbraTestCase
{
    public function testCreateGalSyncAccount()
    {
        $name = $this->faker->word;
        $value= $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $domain = $this->faker->word;
        $mailHost = $this->faker->word;
        $password = $this->faker->uuid;
        $folder = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new CreateGalSyncAccountRequest(
            $name,
            $domain,
            GalMode::BOTH(),
            $account,
            $mailHost,
            $password,
            $folder
        );
        $this->assertSame($name, $request->getName());
        $this->assertSame($domain, $request->getDomain());
        $this->assertEquals(GalMode::BOTH(), $request->getType());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($mailHost, $request->getMailHost());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($folder, $request->getFolder());

        $request = new CreateGalSyncAccountRequest(
            '',
            '',
            GalMode::BOTH(),
            new AccountSelector(AccountBy::NAME(), ''),
            ''
        );
        $request->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::LDAP())
            ->setAccount($account)
            ->setMailHost($mailHost)
            ->setPassword($password)
            ->setFolder($folder)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());
        $this->assertSame($domain, $request->getDomain());
        $this->assertEquals(GalMode::LDAP(), $request->getType());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($mailHost, $request->getMailHost());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($folder, $request->getFolder());

        $accInfo = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);
        $response = new CreateGalSyncAccountResponse($accInfo);
        $this->assertSame($accInfo, $response->getAccount());
        $response = new CreateGalSyncAccountResponse(new AccountInfo('', '', TRUE));
        $response->setAccount($accInfo);
        $this->assertSame($accInfo, $response->getAccount());

        $body = new CreateGalSyncAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateGalSyncAccountBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateGalSyncAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateGalSyncAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateGalSyncAccountRequest name="$name" domain="$domain" type="ldap" password="$password" folder="$folder" server="$mailHost">
            <urn:account by="name">$value</urn:account>
            <urn:a n="$key">$value</urn:a>
        </urn:CreateGalSyncAccountRequest>
        <urn:CreateGalSyncAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:CreateGalSyncAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateGalSyncAccountEnvelope::class, 'xml'));
    }
}
