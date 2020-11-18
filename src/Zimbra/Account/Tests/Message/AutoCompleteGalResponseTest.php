<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AutoCompleteGalResponse;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalResponse.
 */
class AutoCompleteGalResponseTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalResponse()
    {
        $pagingSupported = mt_rand(1, 100);
        $contact = new ContactInfo;

        $res = new AutoCompleteGalResponse(
            FALSE,
            TRUE,
            $pagingSupported,
            [$contact]
        );
        $this->assertFalse($res->getMore());
        $this->assertTrue($res->getTokenizeKey());
        $this->assertSame($pagingSupported, $res->getPagingSupported());
        $this->assertSame([$contact], $res->getContacts());

        $res = new AutoCompleteGalResponse();
        $res->setMore(TRUE)
            ->setTokenizeKey(FALSE)
            ->setPagingSupported($pagingSupported)
            ->setContacts([$contact])
            ->addContact($contact);
        $this->assertTrue($res->getMore());
        $this->assertFalse($res->getTokenizeKey());
        $this->assertSame($pagingSupported, $res->getPagingSupported());
        $this->assertSame([$contact, $contact], $res->getContacts());
    }
}
