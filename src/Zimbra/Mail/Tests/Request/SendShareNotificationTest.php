<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\Action;
use Zimbra\Enum\AddressType;
use Zimbra\Mail\Request\SendShareNotification;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Struct\Id;

/**
 * Testcase class for SendShareNotification.
 */
class SendShareNotificationTest extends ZimbraMailApiTestCase
{
    public function testSendShareNotificationRequest()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->email;
        $personal = $this->faker->word;
        $notes = $this->faker->word;

        $item = new Id($id);
        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);

        $req = new SendShareNotification(
            $item, [$e], $notes, Action::EDIT()
        );
        $this->assertSame($item, $req->getItem());
        $this->assertSame([$e], $req->getEmailAddresses()->all());
        $this->assertSame($notes, $req->getNotes());
        $this->assertTrue($req->getAction()->is('edit'));

        $req->setItem($item)
            ->setEmailAddresses([$e])
            ->addEmailAddress($e)
            ->setNotes($notes)
            ->setAction(Action::EDIT());
        $this->assertSame($item, $req->getItem());
        $this->assertSame([$e, $e], $req->getEmailAddresses()->all());
        $this->assertSame($notes, $req->getNotes());
        $this->assertTrue($req->getAction()->is('edit'));

        $req = new SendShareNotification(
            $item, [$e], $notes, Action::EDIT()
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendShareNotificationRequest action="' . Action::EDIT() . '">'
                .'<item id="' . $id . '" />'
                .'<notes>' . $notes . '</notes>'
                .'<e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
            .'</SendShareNotificationRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendShareNotificationRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'notes' => $notes,
                'action' => Action::EDIT()->value(),
                'item' => array('id' => $id),
                'e' => array(
                    array(
                        'a' => $address,
                        't' => AddressType::FROM()->value(),
                        'p' => $personal,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendShareNotificationApi()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->word;
        $personal = $this->faker->word;
        $notes = $this->faker->word;

        $item = new Id($id);
        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);

        $this->api->sendShareNotification(
            $item, [$e], $notes, Action::EDIT()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendShareNotificationRequest action="' . Action::EDIT() . '">'
                        .'<urn1:item id="' . $id . '" />'
                        .'<urn1:notes>' . $notes . '</urn1:notes>'
                        .'<urn1:e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
                    .'</urn1:SendShareNotificationRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
