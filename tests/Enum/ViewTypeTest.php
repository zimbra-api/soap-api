<?php declare(strict_types=1);

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ViewType;

/**
 * Testcase class for ViewType.
 */
class ViewTypeTest extends TestCase
{
    public function testViewType()
    {
        $values = [
            'CONVERSATION' => 'conversation',
            'MESSAGE'      => 'message',
            'CONTACT'      => 'contact',
            'APPOINTMENT'  => 'appointment',
            'TASK'         => 'task',
            'WIKI'         => 'wiki',
            'DOCUMENT'     => 'document',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ViewType::$enum()->getValue(), $value);
        }
    }
}
