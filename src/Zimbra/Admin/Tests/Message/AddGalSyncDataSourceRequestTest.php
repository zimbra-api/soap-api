<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AddGalSyncDataSourceRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\GalMode;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddGalSyncDataSourceRequest.
 */
class AddGalSyncDataSourceRequestTest extends ZimbraStructTestCase
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
}
