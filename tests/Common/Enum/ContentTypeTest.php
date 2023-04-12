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
        foreach ($values as $name => $value) {
            $this->assertSame(ContentType::from($value)->name, $name);
            $this->assertSame(ContentType::from($value)->value, $value);
        }
    }
}
