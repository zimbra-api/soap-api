<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddRecurrenceInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Common\Struct\AddRecurrenceInfoInterface;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddRecurrenceInfo.
 */
class AddRecurrenceInfoTest extends ZimbraTestCase
{
    public function testRecurrenceInfo()
    {
        $add = new AddRecurrenceInfo();
        $this->assertTrue($add instanceof AddRecurrenceInfoInterface);
        $this->assertTrue($add instanceof RecurrenceInfo);
    }
}
