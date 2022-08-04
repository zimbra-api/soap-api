<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Serializer;

use PHPUnit\Framework\TestCase;;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use Zimbra\Common\Serializer\SerializerFactory;

/**
 * Testcase class for Serializer.
 */
class SerializerTest extends TestCase
{
    public function testSerializer()
    {
        $handler = new StubSerializerHandler();
        $handlers = SerializerFactory::setSerializerHandlers([$handler]);
        $this->assertSame([$handler], $handlers);

        $handlers = SerializerFactory::addSerializerHandler($handler);
        $this->assertSame([$handler, $handler], $handlers);

        $this->assertTrue(SerializerFactory::setDebugMode(TRUE));
        $this->assertFalse(SerializerFactory::setDebugMode(FALSE));
        $this->assertSame(dirname(__FILE__), SerializerFactory::setCacheDir(dirname(__FILE__)));

        SerializerFactory::setCacheDir(NULL);
        $serializer = SerializerFactory::create();
        $this->assertInstanceOf(SerializerInterface::class, $serializer);
    }
}

class StubSerializerHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods(): array
    {
        return [];
    }
}