<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ContactActionOp;

/**
 * Testcase class for ContactActionOp.
 */
class ContactActionOpTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ContactActionOp::$enum()->value(), $value);
        }
    }
}
