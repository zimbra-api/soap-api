<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\AuthTokenControl;

/**
 * Testcase class for AuthTokenControl.
 */
class AuthTokenControlTest extends ZimbraStructTestCase
{
    public function testAuthTokenControl()
    {
        $control = new AuthTokenControl(false);
        $this->assertFalse($control->getVoidOnExpired());
        $control->setVoidOnExpired(true);
        $this->assertTrue($control->getVoidOnExpired());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authTokenControl voidOnExpired="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($control, 'xml'));

        $control = $this->serializer->deserialize($xml, 'Zimbra\Struct\AuthTokenControl', 'xml');
        $this->assertTrue($control->getVoidOnExpired());
    }
}
