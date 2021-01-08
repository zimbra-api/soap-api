<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\InfoSection;

/**
 * Testcase class for InfoSection.
 */
class InfoSectionTest extends TestCase
{
    public function testInfoSection()
    {
        $values = [
            'MBOX'   => 'mbox',
            'PREFS' => 'prefs',
            'ATTRS' => 'attrs',
            'ZIMLETS'  => 'zimlets',
            'PROPS' => 'props',
            'IDENTS'   => 'idents',
            'SIGS'   => 'sigs',
            'DSRCS'   => 'dsrcs',
            'CHILDREN'   => 'children',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(InfoSection::$enum()->getValue(), $value);
        }
    }
}
