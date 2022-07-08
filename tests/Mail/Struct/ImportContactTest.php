<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ImportContact;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImportContact.
 */
class ImportContactTest extends ZimbraTestCase
{
    public function testImportContact()
    {
        $listOfCreatedIds = $this->faker->word;
        $numImported = $this->faker->randomNumber;

        $ic = new ImportContact($listOfCreatedIds, $numImported);
        $this->assertSame($listOfCreatedIds, $ic->getListOfCreatedIds());
        $this->assertSame($numImported, $ic->getNumImported());

        $ic = new ImportContact();
        $ic->setListOfCreatedIds($listOfCreatedIds)
            ->setNumImported($numImported);
        $this->assertSame($listOfCreatedIds, $ic->getListOfCreatedIds());
        $this->assertSame($numImported, $ic->getNumImported());

        $xml = <<<EOT
<?xml version="1.0"?>
<result ids="$listOfCreatedIds" n="$numImported" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ic, 'xml'));
        $this->assertEquals($ic, $this->serializer->deserialize($xml, ImportContact::class, 'xml'));
    }
}
