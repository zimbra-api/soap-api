<?php

namespace Zimbra\Voice\Tests;

use Zimbra\Voice\VoiceFactory;

/**
 * Testcase class for VoiceFactory.
 */
class VoiceFactoryTest extends ZimbraVoiceTestCase
{
    public function testVoiceFactory()
    {
        $httpApi = VoiceFactory::instance();
        $this->assertInstanceOf('\Zimbra\Voice\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Voice\Http', $httpApi);
    }
}
