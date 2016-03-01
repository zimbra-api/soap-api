<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;

/**
 * Testcase class for ExpandedRecurrenceInvite.
 */
class ExpandedRecurrenceInviteTest extends ZimbraMailTestCase
{
    public function testExpandedRecurrenceInvite()
    {
        $comp = new ExpandedRecurrenceInvite();
        $this->assertInstanceOf('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $comp);
    }
}
