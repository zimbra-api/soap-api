<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ContactActionOp;

/**
 * Testcase class for ContactActionOp.
 */
class ContactActionOpTest extends TestCase
{
    public function testContactActionOp()
    {
        $values = [
            'MOVE'   => 'move',
            'DELETE' => 'delete',
            'FLAG'   => 'flag',
            'TRASH'  => 'trash',
            'TAG'    => 'tag',
            'UPDATE' => 'update',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ContactActionOp::from($value)->name, $name);
            $this->assertSame(ContactActionOp::from($value)->value, $value);
        }
    }
}
