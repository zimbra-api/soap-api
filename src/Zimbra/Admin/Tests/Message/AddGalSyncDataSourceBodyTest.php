<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddGalSyncDataSourceBody;
use Zimbra\Admin\Message\AddGalSyncDataSourceRequest;
use Zimbra\Admin\Message\AddGalSyncDataSourceResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\GalMode;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddGalSyncDataSourceBody.
 */
class AddGalSyncDataSourceBodyTest extends ZimbraStructTestCase
{
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
}
