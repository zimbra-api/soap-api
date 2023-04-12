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
        foreach ($values as $name => $value) {
            $this->assertSame(BrowseBy::from($value)->name, $name);
            $this->assertSame(BrowseBy::from($value)->value, $value);
        }
    }
}
