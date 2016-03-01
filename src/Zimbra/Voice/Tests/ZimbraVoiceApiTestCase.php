<?php

namespace Zimbra\Voice\Tests;

use Zimbra\Soap\Tests\Client\LocalClientHttp;
use Zimbra\Voice\Base as VoiceBase;

/**
 * Base testcase class for all Zimbra Voice Api testcases.
 */
abstract class ZimbraVoiceApiTestCase extends ZimbraVoiceTestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();
        $this->api = new LocalVoiceHttp(null);
    }
}

class LocalVoiceHttp extends VoiceBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->setClient(new LocalClientHttp($this->getLocation()));
    }
}
