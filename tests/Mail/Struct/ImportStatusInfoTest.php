<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ImportStatusInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImportStatusInfo.
 */
class ImportStatusInfoTest extends ZimbraTestCase
{
    public function testImportStatusInfo()
    {
        $id = $this->faker->uuid;
        $error = $this->faker->word;

        $status = new ImportStatusInfoExt(
            $id, FALSE, FALSE, $error
        );
        $this->assertSame($id, $status->getId());
        $this->assertFalse($status->getRunning());
        $this->assertFalse($status->getSuccess());
        $this->assertSame($error, $status->getError());

        $status = new ImportStatusInfoExt();
        $status->setId($id)
            ->setRunning(TRUE)
            ->setSuccess(TRUE)
            ->setError($error);
        $this->assertSame($id, $status->getId());
        $this->assertTrue($status->getRunning());
        $this->assertTrue($status->getSuccess());
        $this->assertSame($error, $status->getError());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" isRunning="true" success="true" error="$error" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($status, 'xml'));
        $this->assertEquals($status, $this->serializer->deserialize($xml, ImportStatusInfoExt::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'isRunning' => TRUE,
            'success' => TRUE,
            'error' => $error,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($status, 'json'));
        $this->assertEquals($status, $this->serializer->deserialize($json, ImportStatusInfoExt::class, 'json'));
    }
}

class ImportStatusInfoExt extends ImportStatusInfo {

}
