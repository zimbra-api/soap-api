<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CacheType;

/**
 * Testcase class for CacheType.
 */
class CacheTypeTest extends TestCase
{
    public function testCacheType()
    {
        $values = [
            'SKIN'    => 'skin',
            'LOCALE'  => 'locale',
            'ACCOUNT' => 'account',
            'COS'     => 'cos',
            'DOMAIN'  => 'domain',
            'SERVER'  => 'server',
            'ZIMLET'  => 'zimlet',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(CacheType::from($value)->name, $name);
            $this->assertSame(CacheType::from($value)->value, $value);
        }
    }
}
