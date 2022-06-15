<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\InstanceDataAttrs;
use Zimbra\Mail\Struct\CommonCalendaringData;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommonCalendaringData.
 */
class CommonCalendaringDataTest extends ZimbraTestCase
{
    public function testCommonCalendaringData()
    {
        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $folderId = $this->faker->uuid;
        $size = $this->faker->randomNumber;
        $changeDate = $this->faker->randomNumber;
        $modifiedSequence = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $id = $this->faker->uuid;
 
        $data = new CommonCalendaringDataMock(
            $xUid, $uid, $flags, $tags, $tagNames, $folderId, $size, $changeDate, $modifiedSequence, $revision, $id
        );
        $this->assertSame($xUid, $data->getXUid());
        $this->assertSame($uid, $data->getUid());
        $this->assertSame($flags, $data->getFlags());
        $this->assertSame($tags, $data->getTags());
        $this->assertSame($tagNames, $data->getTagNames());
        $this->assertSame($folderId, $data->getFolderId());
        $this->assertSame($size, $data->getSize());
        $this->assertSame($changeDate, $data->getChangeDate());
        $this->assertSame($modifiedSequence, $data->getModifiedSequence());
        $this->assertSame($revision, $data->getRevision());
        $this->assertSame($id, $data->getId());
        $this->assertTrue($data instanceof InstanceDataAttrs);

        $data = new CommonCalendaringDataMock('', '');
        $data->setXUid($xUid)
             ->setUid($uid)
             ->setFlags($flags)
             ->setTags($tags)
             ->setTagNames($tagNames)
             ->setFolderId($folderId)
             ->setSize($size)
             ->setChangeDate($changeDate)
             ->setModifiedSequence($modifiedSequence)
             ->setRevision($revision)
             ->setId($id);
        $this->assertSame($xUid, $data->getXUid());
        $this->assertSame($uid, $data->getUid());
        $this->assertSame($flags, $data->getFlags());
        $this->assertSame($tags, $data->getTags());
        $this->assertSame($tagNames, $data->getTagNames());
        $this->assertSame($folderId, $data->getFolderId());
        $this->assertSame($size, $data->getSize());
        $this->assertSame($changeDate, $data->getChangeDate());
        $this->assertSame($modifiedSequence, $data->getModifiedSequence());
        $this->assertSame($revision, $data->getRevision());
        $this->assertSame($id, $data->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result x_uid="$xUid" uid="$uid" f="$flags" t="$tags" tn="$tagNames" l="$folderId" s="$size" md="$changeDate" ms="$modifiedSequence" rev="$revision" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, CommonCalendaringDataMock::class, 'xml'));

        $json = json_encode([
            'x_uid' => $xUid,
            'uid' => $uid,
            'f' => $flags,
            't' => $tags,
            'tn' => $tagNames,
            'l' => $folderId,
            's' => $size,
            'md' => $changeDate,
            'ms' => $modifiedSequence,
            'rev' => $revision,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($data, 'json'));
        $this->assertEquals($data, $this->serializer->deserialize($json, CommonCalendaringDataMock::class, 'json'));
    }
}

class CommonCalendaringDataMock extends CommonCalendaringData
{
}
