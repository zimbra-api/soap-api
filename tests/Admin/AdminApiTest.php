<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin;

use Zimbra\Admin\{AdminApi, AdminApiInterface};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class AdminApiTest extends ZimbraTestCase
{
    public function testAdminApi()
    {
        $api = $this->createStub(AdminApi::class);
        $this->assertTrue($api instanceof AdminApiInterface);
    }
}
