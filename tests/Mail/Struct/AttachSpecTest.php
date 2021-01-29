<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttachSpec.
 */
class AttachSpecTest extends ZimbraTestCase
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
