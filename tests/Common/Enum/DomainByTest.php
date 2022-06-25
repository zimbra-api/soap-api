<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DomainBy;

/**
 * Testcase class for DomainBy.
 */
class DomainByTest extends TestCase
{
    public function testDomainBy()
    {
        $values = [
            'ID'               => 'id',
            'NAME'             => 'name',
            'VIRTUAL_HOSTNAME' => 'virtualHostname',
            'KRB5_REALM'       => 'krb5Realm',
            'FOREIGN_NAME'     => 'foreignName',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DomainBy::$enum()->getValue(), $value);
        }
    }
}
