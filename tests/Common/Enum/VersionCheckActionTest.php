<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\VersionCheckAction;

/**
 * Testcase class for VersionCheckAction.
 */
class VersionCheckActionTest extends TestCase
{
    public function testVersionCheckAction()
    {
        $values = [
            'CHECK'  => 'check',
            'STATUS' => 'status',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(VersionCheckAction::from($value)->value, $value);
            $this->assertSame(VersionCheckAction::from($value)->name, $name);
        }
    }
}
