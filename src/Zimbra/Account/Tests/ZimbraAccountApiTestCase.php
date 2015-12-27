<?php

namespace Zimbra\Account\Tests;

use Zimbra\Soap\Tests\Client\LocalClientHttp;
use Zimbra\Account\Base as AccountBase;

/**
 * Base testcase class for all Zimbra Account Api testcases.
 */
abstract class ZimbraAccountApiTestCase extends ZimbraAccountTestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();
        $this->api = new LocalAccountHttp(null);
    }
}

class LocalAccountHttp extends AccountBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->setClient(new LocalClientHttp($this->getLocation()));
    }
}
