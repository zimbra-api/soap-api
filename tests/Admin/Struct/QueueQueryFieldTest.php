<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for QueueQueryField.
 */
class QueueQueryFieldTest extends ZimbraTestCase
{
    public function testQueueQueryField()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $name = $this->faker->word;

        $match1 = new ValueAttrib($value1);
        $match2 = new ValueAttrib($value2);

        $field = new QueueQueryField($name, [$match1]);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1], $field->getMatches());

        $field = new QueueQueryField('');
        $field->setName($name)
              ->setMatches([$match1])
              ->addMatch($match2);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1, $match2], $field->getMatches());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">
    <match value="$value1" />
    <match value="$value2" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($field, 'xml'));
        $this->assertEquals($field, $this->serializer->deserialize($xml, QueueQueryField::class, 'xml'));
    }
}
