<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DocumentGrantType;

/**
 * Testcase class for DocumentGrantType.
 */
class DocumentGrantTypeTest extends TestCase
{
    public function testDocumentGrantType()
    {
        $values = [
            'ALL' => 'all',
            'PUB' => 'pub',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(DocumentGrantType::from($value)->name, $name);
            $this->assertSame(DocumentGrantType::from($value)->value, $value);
        }
    }
}
