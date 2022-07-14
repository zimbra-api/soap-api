<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\TagActionOp;

/**
 * Testcase class for TagActionOp.
 */
class TagActionOpTest extends TestCase
{
    public function testTagActionOp()
    {
        $values = [
            'READ'      => 'read',
            'RENAME'    => 'rename',
            'COLOR'     => 'color',
            'DELETE'    => 'delete',
            'UPDATE'    => 'update',
            'RETENTION' => 'retentionpolicy',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(TagActionOp::$enum()->getValue(), $value);
        }
    }
}