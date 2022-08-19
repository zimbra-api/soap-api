<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AutoCompleteMatchType;

/**
 * Testcase class for AutoCompleteMatchType.
 */
class AutoCompleteMatchTypeTest extends TestCase
{
    public function testAutoCompleteMatchType()
    {
        $values = [
            'GAL' => 'gal',
            'CONTACT'  => 'contact',
            'RANKING_TABLE'  => 'rankingTable',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AutoCompleteMatchType::$enum()->getValue(), $value);
        }
    }
}
