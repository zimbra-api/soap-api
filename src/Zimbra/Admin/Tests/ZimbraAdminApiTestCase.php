<?php

namespace Zimbra\Admin\Tests;

use Zimbra\Soap\Tests\Client\LocalClientHttp;
use Zimbra\Admin\Base as AdminBase;

/**
 * Base testcase class for all Zimbra Admin Api testcases.
 */
abstract class ZimbraAdminApiTestCase extends ZimbraAdminTestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();
        $this->api = new LocalAdminHttp(null);
    }
}

class LocalAdminHttp extends AdminBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->setClient(new LocalClientHttp($this->getLocation()));
    }
}
