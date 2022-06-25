<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\BrowseBy;

/**
 * Testcase class for BrowseBy.
 */
class BrowseByTest extends TestCase
{
    public function testBrowseBy()
    {
        $values = [
            'DOMAINS'     => 'domains',
            'ATTACHMENTS' => 'attachments',
            'OBJECTS'     => 'objects',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(BrowseBy::$enum()->getValue(), $value);
        }
    }
}
