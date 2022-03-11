<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ActionSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ActionSelector.
 */
class ActionSelectorTest extends ZimbraTestCase
{
    public function testActionSelector()
    {
        $operation = $this->faker->word;
        $ids = $this->faker->uuid;
        $constraint = $this->faker->word;
        $tag = $this->faker->numberBetween(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $action = new ActionSelector(
            $operation, $ids, $constraint, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, FALSE, FALSE
        );
        $this->assertSame($ids, $action->getIds());
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($constraint, $action->getConstraint());
        $this->assertSame($tag, $action->getTag());
        $this->assertSame($folder, $action->getFolder());
        $this->assertSame($rgb, $action->getRgb());
        $this->assertSame($color, $action->getColor());
        $this->assertSame($name, $action->getName());
        $this->assertSame($flags, $action->getFlags());
        $this->assertSame($tags, $action->getTags());
        $this->assertSame($tagNames, $action->getTagNames());
        $this->assertFalse($action->getNonExistentIds());
        $this->assertFalse($action->getNewlyCreatedIds());

        $action = new ActionSelector('');
        $action->setIds($ids)
            ->setOperation($operation)
            ->setConstraint($constraint)
            ->setTag($tag)
            ->setFolder($folder)
            ->setRgb($rgb)
            ->setColor($color)
            ->setName($name)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setNonExistentIds(TRUE)
            ->setNewlyCreatedIds(TRUE);
        $this->assertSame($ids, $action->getIds());
        $this->assertSame($operation, $action->getOperation());
        $this->assertSame($constraint, $action->getConstraint());
        $this->assertSame($tag, $action->getTag());
        $this->assertSame($folder, $action->getFolder());
        $this->assertSame($rgb, $action->getRgb());
        $this->assertSame($color, $action->getColor());
        $this->assertSame($name, $action->getName());
        $this->assertSame($flags, $action->getFlags());
        $this->assertSame($tags, $action->getTags());
        $this->assertSame($tagNames, $action->getTagNames());
        $this->assertTrue($action->getNonExistentIds());
        $this->assertTrue($action->getNewlyCreatedIds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" tcon="$constraint" tag="$tag" l="$folder" rgb="$rgb" color="$color" name="$name" f="$flags" t="$tags" tn="$tagNames" nei="true" nci="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ActionSelector::class, 'xml'));

        $json = json_encode([
            'id' => $ids,
            'op' => $operation,
            'tcon' => $constraint,
            'tag' => $tag,
            'l' => $folder,
            'rgb' => $rgb,
            'color' => $color,
            'name' => $name,
            'f' => $flags,
            't' => $tags,
            'tn' => $tagNames,
            'nei' => TRUE,
            'nci' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ActionSelector::class, 'json'));
    }
}
