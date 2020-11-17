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
use Zimbra\Soap\Header;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddGalSyncDataSource.
 */
class AddGalSyncDataSourceTest extends ZimbraStructTestCase
{
    public function testAddGalSyncDataSourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $domain = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new AddGalSyncDataSourceRequest(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertEquals(GalMode::BOTH(), $req->getType());
        $this->assertSame($folder, $req->getFolder());

        $req = new AddGalSyncDataSourceRequest(
            new AccountSelector(AccountBy::NAME(), $value), '', '', GalMode::BOTH()
        );
        $req->setAccount($account)
            ->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::ZIMBRA())
            ->setFolder($folder)
            ->setAttrs([$attr]);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertEquals(GalMode::ZIMBRA(), $req->getType());
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::ZIMBRA() . '" folder="' . $folder . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</AddGalSyncDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddGalSyncDataSourceRequest::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddGalSyncDataSourceRequest::class, 'json'));
    }

    public function testAddGalSyncDataSourceResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);
        $res = new AddGalSyncDataSourceResponse($account);

        $this->assertSame($account, $res->getAccount());

        $res = new AddGalSyncDataSourceResponse(
            new AccountInfo($name, $id, TRUE, [$attr])
        );
        $res->setAccount($account);
        $this->assertSame($account, $res->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddGalSyncDataSourceResponse>'
                . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</account>'
            . '</AddGalSyncDataSourceResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddGalSyncDataSourceResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddGalSyncDataSourceResponse::class, 'json'));
    }

    public function testAddGalSyncDataSourceBody()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domain = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new Attr($key, $value);
        $request = new AddGalSyncDataSourceRequest(
            new AccountSelector(AccountBy::NAME(), $value), $name, $domain, GalMode::ZIMBRA(), $folder, [$attr]
        );
        $response = new AddGalSyncDataSourceResponse(
            new AccountInfo($name, $id, TRUE, [new Attr($key, $value)])
        );

        $body = new AddGalSyncDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddGalSyncDataSourceBody;
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::ZIMBRA() . '" folder="' . $folder . '">'
                    . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:AddGalSyncDataSourceRequest>'
                . '<urn:AddGalSyncDataSourceResponse>'
                    . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</account>'
                . '</urn:AddGalSyncDataSourceResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddGalSyncDataSourceBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddGalSyncDataSourceBody::class, 'json'));
    }

    public function testAddGalSyncDataSourceEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domain = $this->faker->word;
        $folder = $this->faker->word;

        $attr = new Attr($key, $value);
        $request = new AddGalSyncDataSourceRequest(
            new AccountSelector(AccountBy::NAME(), $value), $name, $domain, GalMode::ZIMBRA(), $folder, [$attr]
        );
        $response = new AddGalSyncDataSourceResponse(
            new AccountInfo($name, $id, TRUE, [new Attr($key, $value)])
        );
        $body = new AddGalSyncDataSourceBody($request, $response);

        $envelope = new AddGalSyncDataSourceEnvelope(new Header, $body);
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
