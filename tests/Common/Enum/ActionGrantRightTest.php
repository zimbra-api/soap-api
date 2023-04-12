<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ActionGrantRight;

/**
 * Testcase class for ActionGrantRight.
 */
class ActionGrantRightTest extends TestCase
{
    public function testActionGrantRight()
    {
        $values = [
            'READ'             => 'r',
            'WRITE'            => 'w',
            'INSERT'           => 'i',
            'DELETE'           => 'd',
            'ADMINISTER'       => 'a',
            'WORKFLOW_ACTION'  => 'x',
            'VIEW_PRIVATE'     => 'p',
            'VIEW_FREEBUSY'    => 'f',
            'CREATE_SUBFOLDER' => 'c',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ActionGrantRight::from($value)->name, $name);
            $this->assertSame(ActionGrantRight::from($value)->value, $value);
        }
    }
}
