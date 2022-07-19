<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Response;

use Zimbra\Admin\Message\AddGalSyncDataSourceBody;
use Zimbra\Admin\Message\AddGalSyncDataSourceEnvelope;
use Zimbra\Admin\Message\AddGalSyncDataSourceRequest;
use Zimbra\Admin\Message\AddGalSyncDataSourceResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\GalMode;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddGalSyncDataSource.
 */
class AddGalSyncDataSourceTest extends ZimbraTestCase
{
    public function testAddGalSyncDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $domain = $this->faker->domainName;
        $folder = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $request = new AddGalSyncDataSourceRequest(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($name, $request->getName());
        $this->assertSame($domain, $request->getDomain());
        $this->assertEquals(GalMode::BOTH(), $request->getType());
        $this->assertSame($folder, $request->getFolder());

        $request = new AddGalSyncDataSourceRequest(
            new AccountSelector(), '', '', GalMode::BOTH()
        );
        $request->setAccount($account)
            ->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::ZIMBRA())
            ->setFolder($folder)
            ->setAttrs([$attr]);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($name, $request->getName());
        $this->assertSame($domain, $request->getDomain());
        $this->assertEquals(GalMode::ZIMBRA(), $request->getType());
        $this->assertSame($folder, $request->getFolder());

        $account = new AccountInfo($name, $id, TRUE, [$attr]);
        $response = new AddGalSyncDataSourceResponse(
            $account
        );
        $this->assertSame($account, $response->getAccount());
        $response = new AddGalSyncDataSourceResponse();
        $response->setAccount($account);
        $this->assertSame($account, $response->getAccount());

        $body = new AddGalSyncDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddGalSyncDataSourceBody;
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddGalSyncDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddGalSyncDataSourceEnvelope;
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $by = AccountBy::NAME()->getValue();
        $type = GalMode::ZIMBRA()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddGalSyncDataSourceRequest name="$name" domain="$domain" type="$type" folder="$folder">
            <urn:account by="$by">$value</urn:account>
            <urn:a n="$key">$value</urn:a>
        </urn:AddGalSyncDataSourceRequest>
        <urn:AddGalSyncDataSourceResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:AddGalSyncDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddGalSyncDataSourceEnvelope::class, 'xml'));
    }
}
