<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\SectionType;

/**
 * Testcase class for SectionType.
 */
class SectionTypeTest extends TestCase
{
    public function testSectionType()
    {
        $values = [
            'MBOX'     => 'mbox',
            'PREFS'    => 'prefs',
            'ATTRS'    => 'attrs',
            'ZIMLETS'  => 'zimlets',
            'PROPS'    => 'props',
            'IDENTS'   => 'idents',
            'SIGS'     => 'sigs',
            'DSRCS'    => 'dsrcs',
            'CHILDREN' => 'children',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(SectionType::$enum()->getValue(), $value);
        }
    }
}
