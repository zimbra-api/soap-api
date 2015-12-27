<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for ServerBy.
 */
class ServerByTest extends PHPUnit_Framework_TestCase
{
    public function testServerBy()
    {
        $values = [
            'ID'               => 'id',
            'NAME'             => 'name',
            'SERVICE_HOSTNAME' => 'serviceHostname',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ServerBy::$enum()->value(), $value);
        }
    }
}
