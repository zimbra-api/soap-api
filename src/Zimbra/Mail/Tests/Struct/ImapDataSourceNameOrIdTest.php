<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;

/**
 * Testcase class for ImapDataSourceNameOrId.
 */
class ImapDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testImapDataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $imap = new ImapDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $imap);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<imap name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $imap);

        $array = array(
            'imap' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $imap->toArray());
    }
}
