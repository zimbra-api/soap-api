<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ContentType;

/**
 * Testcase class for ContentType.
 */
class ContentTypeTest extends TestCase
{
    public function testContentType()
    {
        $values = [
            'TEXT_PLAIN' => 'text/plain',
            'TEXT_HTML'  => 'text/html',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ContentType::$enum()->value(), $value);
        }
    }
}
