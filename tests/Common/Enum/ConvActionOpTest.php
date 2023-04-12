<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ConvActionOp;

/**
 * Testcase class for ConvActionOp.
 */
class ConvActionOpTest extends TestCase
{
    public function testConvActionOp()
    {
        $values = [
            'DELETE'   => 'delete',
            'READ'     => 'read',
            'FLAG'     => 'flag',
            'PRIORITY' => 'priority',
            'TAG'      => 'tag',
            'MOVE'     => 'move',
            'SPAM'     => 'spam',
            'TRASH'    => 'trash',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ConvActionOp::from($value)->name, $name);
            $this->assertSame(ConvActionOp::from($value)->value, $value);
        }
    }
}
