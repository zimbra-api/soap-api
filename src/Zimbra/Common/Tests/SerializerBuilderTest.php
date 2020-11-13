<?php

namespace Zimbra\Common\Tests;

use PHPUnit\Framework\TestCase;;
use JMS\Serializer\SerializerInterface;
use Zimbra\Common\SerializerBuilder;
use Zimbra\Common\Serializer\{JsonDeserializationVisitorFactory, JsonSerializationVisitorFactory, XmlDeserializationVisitorFactory};

/**
 * Testcase class for SerializerBuilder.
 */
class SerializerBuilderTest extends TestCase
{

    public function testSerializerBuilder()
    {
        $serializer = SerializerBuilder::getSerializer();
        $this->assertTrue($serializer instanceof SerializerInterface);
    }
}
