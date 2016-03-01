<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;

/**
 * Testcase class for AttachSpec.
 */
class AttachSpecTest extends ZimbraMailTestCase
{
    public function testAttachSpec()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Mail\Struct\AttachSpec');
        $stub->setOptional(true);
        $this->assertTrue($stub->getOptional());
    }
}
