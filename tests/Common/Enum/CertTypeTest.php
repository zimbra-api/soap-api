<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CertType;

/**
 * Testcase class for CertType.
 */
class CertTypeTest extends TestCase
{
    public function testCertType()
    {
        $values = [
            'ALL'      => 'all',
            'MTA'      => 'mta',
            'LDAP'     => 'ldap',
            'MAILBOXD' => 'mailboxd',
            'PROXY'    => 'proxy',
            'STAGED'   => 'staged',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(CertType::from($value)->name, $name);
            $this->assertSame(CertType::from($value)->value, $value);
        }
    }
}
