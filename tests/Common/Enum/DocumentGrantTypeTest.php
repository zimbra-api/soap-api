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
        foreach ($values as $enum => $value) {
            $this->assertSame(DocumentGrantType::$enum()->getValue(), $value);
        }
    }
}
