<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DocumentGrantType;

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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DocumentGrantType::$enum()->value(), $value);
        }
    }
}
