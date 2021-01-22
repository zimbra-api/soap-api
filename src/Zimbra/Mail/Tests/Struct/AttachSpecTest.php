<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AttachSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AttachSpec.
 */
class AttachSpecTest extends ZimbraStructTestCase
{
    public function testAttachSpec()
    {
        $stub = new StubAttachSpec(FALSE);
        $this->assertFalse($stub->getOptional());
        $stub->setOptional(TRUE);
        $this->assertTrue($stub->getOptional());
    }
}

class StubAttachSpec extends AttachSpec
{
}
