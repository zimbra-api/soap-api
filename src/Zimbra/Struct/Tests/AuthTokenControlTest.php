<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\AuthTokenControl;

/**
 * Testcase class for AuthTokenControl.
 */
class AuthTokenControlTest extends ZimbraStructTestCase
{
    public function testAuthTokenControl()
    {
        $control = new AuthTokenControl(FALSE);
        $this->assertFalse($control->getVoidOnExpired());
        $control->setVoidOnExpired(TRUE);
        $this->assertTrue($control->getVoidOnExpired());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authTokenControl voidOnExpired="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($control, 'xml'));
        $this->assertEquals($control, $this->serializer->deserialize($xml, AuthTokenControl::class, 'xml'));

        $json = json_encode([
            'voidOnExpired' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($control, 'json'));
        $this->assertEquals($control, $this->serializer->deserialize($json, AuthTokenControl::class, 'json'));
    }
}
