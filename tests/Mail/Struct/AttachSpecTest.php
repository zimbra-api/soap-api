<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AttachSpec;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

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
