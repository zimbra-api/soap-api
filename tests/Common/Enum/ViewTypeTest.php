<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ViewType;

/**
 * Testcase class for ViewType.
 */
class ViewTypeTest extends TestCase
{
    public function testViewType()
    {
        $values = [
            'UNKNOWN'              => '',
            'SEARCH_FOLDER'        => 'search folder',
            'TAG'                  => 'tag',
            'CONVERSATION'         => 'conversation',
            'MESSAGE'              => 'message',
            'CONTACT'              => 'contact',
            'DOCUMENT'             => 'document',
            'APPOINTMENT'          => 'appointment',
            'VIRTUAL_CONVERSATION' => 'virtual conversation',
            'REMOTE_FOLDER'        => 'remote folder',
            'WIKI'                 => 'wiki',
            'TASK'                 => 'task',
            'CHAT'                 => 'chat',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ViewType::$enum()->getValue(), $value);
        }
    }
}
