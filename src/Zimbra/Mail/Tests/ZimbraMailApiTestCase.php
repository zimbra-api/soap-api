<?php

namespace Zimbra\Mail\Tests;

use Zimbra\Soap\Tests\Client\LocalClientHttp;
use Zimbra\Mail\Base as MailBase;

/**
 * Base testcase class for all Zimbra Mail Api testcases.
 */
abstract class ZimbraMailApiTestCase extends ZimbraMailTestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();
        $this->api = new LocalMailHttp(null);
    }
}

class LocalMailHttp extends MailBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->setClient(new LocalClientHttp($this->getLocation()));
    }
}
