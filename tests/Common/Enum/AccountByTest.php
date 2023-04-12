<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AccountBy;

/**
 * Testcase class for AccountBy.
 */
class AccountByTest extends TestCase
{
    public function testAccountBy()
    {
        $values = [
            'ADMIN_NAME'        => 'adminName',
            'APP_ADMIN_NAME'    => 'appAdminName',
            'ID'                => 'id',
            'FOREIGN_PRINCIPAL' => 'foreignPrincipal',
            'NAME'              => 'name',
            'KRB5_PRINCIPAL'    => 'krb5Principal',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(AccountBy::from($value)->name, $name);
            $this->assertSame(AccountBy::from($value)->value, $value);
        }
    }
}
