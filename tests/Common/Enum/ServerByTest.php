<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ServerBy;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ServerBy::from($value)->name, $name);
            $this->assertSame(ServerBy::from($value)->value, $value);
        }
    }
}
