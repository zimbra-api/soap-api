<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AutoCompleteGalRequest;
use Zimbra\Enum\GalSearchType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalRequest.
 */
class AutoCompleteGalRequestTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalRequest()
    {
        $name = $this->faker->word;
        $galAccountId = $this->faker->word;
        $limit = mt_rand(1, 100);

        $req = new AutoCompleteGalRequest(
            $name,
            GalSearchType::ALL(),
            FALSE,
            $galAccountId,
            $limit
        );
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ALL(), $req->getType());
        $this->assertFalse($req->getNeedCanExpand());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req = new AutoCompleteGalRequest('');
        $req->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setNeedCanExpand(TRUE)
            ->setGalAccountId($galAccountId)
            ->setLimit($limit);
        $this->assertSame($name, $req->getName());
        $this->assertEquals(GalSearchType::ACCOUNT(), $req->getType());
        $this->assertTrue($req->getNeedCanExpand());
        $this->assertSame($galAccountId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest xmlns="urn:zimbraAccount" name="' . $name . '" type="'. GalSearchType::ACCOUNT() . '" needExp="true" galAcctId="' . $galAccountId . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoCompleteGalRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'type' => (string) GalSearchType::ACCOUNT(),
            'needExp' => TRUE,
            'galAcctId' => $galAccountId,
            'limit' => $limit,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoCompleteGalRequest::class, 'json'));
    }
}
