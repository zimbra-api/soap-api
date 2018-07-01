<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\LoggingLevel;

/**
 * Testcase class for LoggingLevel.
 */
class LoggingLevelTest extends TestCase
{
    public function testLoggingLevel()
    {
        $values = [
            'ERROR' => 'error',
            'WARN'  => 'warn',
            'INFO'  => 'info',
            'DEBUG' => 'debug',
            'TRACE' => 'trace',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(LoggingLevel::$enum()->value(), $value);
        }
    }
}
