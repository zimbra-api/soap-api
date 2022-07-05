<?php declare(strict_types=1);

namespace Zimbra\Tests\Common;

use PHPUnit\Framework\TestCase;;
use JMS\Serializer\SerializerInterface;
use Zimbra\Common\SerializerFactory;

/**
 * Testcase class for SerializerFactory.
 */
class SerializerFactoryTest extends TestCase
{

    public function testSerializerFactory()
    {
        $serializer = SerializerFactory::create();
        $this->assertTrue($serializer instanceof SerializerInterface);
    }
}
