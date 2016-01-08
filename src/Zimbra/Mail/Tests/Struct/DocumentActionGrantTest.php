<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;
use Zimbra\Mail\Struct\DocumentActionGrant;

/**
 * Testcase class for DocumentActionGrant.
 */
class DocumentActionGrantTest extends ZimbraMailTestCase
{
    public function testDocumentActionGrant()
    {
        $expiry = mt_rand(1, 100);
        $grant = new DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), $expiry
        );
        $this->assertTrue($grant->getRights()->is('r'));
        $this->assertTrue($grant->getGrantType()->is('all'));
        $this->assertSame($expiry, $grant->getExpiry());

        $grant->setRights(DocumentPermission::READ())
              ->setGrantType(DocumentGrantType::ALL())
              ->setExpiry($expiry);
        $this->assertTrue($grant->getRights()->is('r'));
        $this->assertTrue($grant->getGrantType()->is('all'));
        $this->assertSame($expiry, $grant->getExpiry());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<grant perm="' . DocumentPermission::READ() . '" gt="' . DocumentGrantType::ALL() . '" expiry="' . $expiry . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grant);

        $array = array(
            'grant' => array(
                'perm' => DocumentPermission::READ()->value(),
                'gt' => DocumentGrantType::ALL()->value(),
                'expiry' => $expiry,
            ),
        );
        $this->assertEquals($array, $grant->toArray());
    }
}
