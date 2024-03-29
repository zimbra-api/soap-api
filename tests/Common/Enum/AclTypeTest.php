<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AclType;

/**
 * Testcase class for AclType.
 */
class AclTypeTest extends TestCase
{
    public function testAclType()
    {
        $values = [
            'GRANT' => 'grant',
            'DENY'  => 'deny',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(AclType::from($value)->name, $name);
            $this->assertSame(AclType::from($value)->value, $value);
        }
    }
}
