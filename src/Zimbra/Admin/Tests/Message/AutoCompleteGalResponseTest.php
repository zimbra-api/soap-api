<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AutoCompleteGalResponse;
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalResponse.
 */
class AutoCompleteGalResponseTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalResponse()
    {
        $contact = new ContactInfo();

        $res = new AutoCompleteGalResponse(
            FALSE, FALSE, FALSE, [$contact]
        );
        $this->assertFalse($res->getMore());
        $this->assertFalse($res->getTokenizeKey());
        $this->assertFalse($res->getPagingSupported());
        $this->assertSame([$contact], $res->getContacts());

        $res->setMore(TRUE)
            ->setTokenizeKey(TRUE)
            ->setPagingSupported(TRUE)
            ->setContacts([$contact])
            ->addContact($contact);
        $this->assertTrue($res->getMore());
        $this->assertTrue($res->getTokenizeKey());
        $this->assertTrue($res->getPagingSupported());
        $this->assertSame([$contact, $contact], $res->getContacts());

        $res = new AutoCompleteGalResponse(
            TRUE, TRUE, TRUE, [$contact]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">'
                . '<cn />'
            . '</AutoCompleteGalResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoCompleteGalResponse::class, 'xml'));

        $json = json_encode([
            'more' => TRUE,
            'tokenizeKey' => TRUE,
            'paginationSupported' => TRUE,
            'cn' => [
                new \stdClass
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoCompleteGalResponse::class, 'json'));
    }
}
