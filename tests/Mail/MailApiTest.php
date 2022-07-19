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
        $api = $this->createStub(MailApi::class);
        $this->assertTrue($api instanceof MailApiInterface);
    }
}
