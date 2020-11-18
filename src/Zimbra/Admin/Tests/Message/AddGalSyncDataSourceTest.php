<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AddGalSyncDataSourceBody;
use Zimbra\Admin\Message\AddGalSyncDataSourceEnvelope;
use Zimbra\Admin\Message\AddGalSyncDataSourceRequest;
use Zimbra\Admin\Message\AddGalSyncDataSourceResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\GalMode;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddGalSyncDataSource.
 */
class AddGalSyncDataSourceTest extends ZimbraStructTestCase
{
    public function testAddGalSyncDataSource()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domain = $this->faker->word;
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
            new AccountSelector(AccountBy::NAME(), ''), '', '', GalMode::BOTH()
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

        $accInfo = new AccountInfo($name, $id, TRUE, [$attr]);
        $response = new AddGalSyncDataSourceResponse(
            $accInfo
        );
        $this->assertSame($accInfo, $response->getAccount());
        $response = new AddGalSyncDataSourceResponse(
            new AccountInfo('', '', TRUE)
        );
        $response->setAccount($accInfo);
        $this->assertSame($accInfo, $response->getAccount());

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::ZIMBRA() . '" folder="' . $folder . '">'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:AddGalSyncDataSourceRequest>'
                    . '<urn:AddGalSyncDataSourceResponse>'
                        . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</account>'
                    . '</urn:AddGalSyncDataSourceResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddGalSyncDataSourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddGalSyncDataSourceRequest' => [
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $value,
                    ],
                    'name' => $name,
                    'domain' => $domain,
                    'type' => (string) GalMode::ZIMBRA(),
                    'folder' => $folder,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddGalSyncDataSourceResponse' => [
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddGalSyncDataSourceEnvelope::class, 'json'));
    }
}
