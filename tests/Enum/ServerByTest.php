<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for ServerBy.
 */
class ServerByTest extends TestCase
{
    public function testServerBy()
    {
        $values = [
            'ID'               => 'id',
            'NAME'             => 'name',
            'SERVICE_HOSTNAME' => 'serviceHostname',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ServerBy::$enum()->getValue(), $value);
        }
    }
}