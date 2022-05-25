<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\AuthTokenControl;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AuthTokenControl.
 */
class AuthTokenControlTest extends ZimbraTestCase
{
    public function testAuthTokenControl()
    {
        $control = new AuthTokenControl(FALSE);
        $this->assertFalse($control->getVoidOnExpired());
        $control->setVoidOnExpired(TRUE);
        $this->assertTrue($control->getVoidOnExpired());

        $xml = <<<EOT
<?xml version="1.0"?>
<result voidOnExpired="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($control, 'xml'));
        $this->assertEquals($control, $this->serializer->deserialize($xml, AuthTokenControl::class, 'xml'));

        $json = json_encode([
            'voidOnExpired' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($control, 'json'));
        $this->assertEquals($control, $this->serializer->deserialize($json, AuthTokenControl::class, 'json'));
    }
}
