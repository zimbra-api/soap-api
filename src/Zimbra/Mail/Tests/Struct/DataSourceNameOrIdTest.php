<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;

/**
 * Testcase class for DataSourceNameOrId.
 */
class DataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testDataSourceNameOrId()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Mail\Struct\DataSourceNameOrId');
        $this->assertInstanceOf('Zimbra\Mail\Struct\NameOrId', $stub);
    }
}
