<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Serializer;

use PHPUnit\Framework\TestCase;;
use JMS\Serializer\SerializerInterface;
use Zimbra\Common\Serializer\SerializerFactory;

/**
 * Testcase class for Serializer.
 */
class SerializerTest extends TestCase
{
    public function testSerializerFactory()
    {
        $serializer = SerializerFactory::create();
        $this->assertTrue($serializer instanceof SerializerInterface);
    }
}
