<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail;

use Zimbra\Mail\{MailApi, MailApiInterface};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class MailApiTest extends ZimbraTestCase
{
    public function testMailApi()
    {
        $api = new MailApi('https://localhost');
        $this->assertTrue($api instanceof MailApiInterface);
    }
}
