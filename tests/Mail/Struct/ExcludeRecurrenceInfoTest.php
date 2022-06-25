<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ExcludeRecurrenceInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Common\Struct\ExcludeRecurrenceInfoInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExcludeRecurrenceInfo.
 */
class ExcludeRecurrenceInfoTest extends ZimbraTestCase
{
    public function testExcludeRecurrenceInfo()
    {
        $exclude = new ExcludeRecurrenceInfo();
        $this->assertTrue($exclude instanceof RecurrenceInfo);
        $this->assertTrue($exclude instanceof ExcludeRecurrenceInfoInterface);
    }
}
