<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ContactActionOp;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(ContactActionOp::$enum()->getValue(), $value);
        }
    }
}