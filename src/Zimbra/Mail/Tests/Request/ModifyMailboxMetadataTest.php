<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ModifyMailboxMetadata;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for ModifyMailboxMetadata.
 */
class ModifyMailboxMetadataTest extends ZimbraMailApiTestCase
{
    public function testModifyMailboxMetadataRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;
        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);

        $req = new ModifyMailboxMetadata(
            $meta
        );
        $this->assertSame($meta, $req->getMailCustomMetadata());

        $req = new ModifyMailboxMetadata(
            new MailCustomMetadata($section)
        );
        $req->setMailCustomMetadata($meta);
        $this->assertSame($meta, $req->getMailCustomMetadata());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyMailboxMetadataRequest>'
                .'<meta section="' . $section . '">'
                    .'<a n="' . $key . '">' . $value . '</a>'
                .'</meta>'
            .'</ModifyMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyMailboxMetadataRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'meta' => array(
                    'a' => array(
                        array(
                            '_content' => $value,
                            'n' => $key,
                        )
                    ),
                    'section' => $section,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyMailboxMetadataApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;
        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);
        $this->api->modifyMailboxMetadata(
            $meta
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyMailboxMetadataRequest>'
                        .'<urn1:meta section="' . $section . '">'
                            .'<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:ModifyMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
