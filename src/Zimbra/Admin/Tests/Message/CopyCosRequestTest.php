<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CopyCosRequest;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CopyCosRequest.
 */
class CopyCosRequestTest extends ZimbraStructTestCase
{
    public function testCopyCosRequest()
    {
        $newName = $this->faker->word;
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);

        $req = new CopyCosRequest($cos, $newName);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($newName, $req->getNewName());

        $req = new CopyCosRequest();
        $req->setCos($cos)
            ->setNewName($newName);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CopyCosRequest>'
                . '<name>' . $newName . '</name>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</CopyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CopyCosRequest::class, 'xml'));

        $json = json_encode([
            'name' => [
                '_content' => $newName,
            ],
            'cos' => [
                'by' => (string) CosBy::NAME(),
                '_content' => $value,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CopyCosRequest::class, 'json'));
    }
}
