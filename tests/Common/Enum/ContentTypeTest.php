<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ContentType;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(ContentType::$enum()->getValue(), $value);
        }
    }
}
