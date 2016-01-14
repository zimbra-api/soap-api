<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\TargetType;
use Zimbra\Mail\Request\CheckPermission;
use Zimbra\Mail\Struct\TargetSpec;

/**
 * Testcase class for CheckPermission.
 */
class CheckPermissionTest extends ZimbraMailApiTestCase
{
    public function testCheckPermissionRequest()
    {
        $value = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;
        $target = new TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), $value
        );
        $req = new CheckPermission($target, [$right1]);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame([$right1], $req->getRights()->all());

        $req->setTarget($target)
            ->addRight($right2);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame([$right1, $right2], $req->getRights()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckPermissionRequest>'
                .'<target type="' . TargetType::ACCOUNT() . '" by="' . AccountBy::NAME() . '">' . $value . '</target>'
                .'<right>' . $right1 . '</right>'
                .'<right>' . $right2 . '</right>'
            .'</CheckPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckPermissionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'target' => array(
                    'type' => TargetType::ACCOUNT()->value(),
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ),
                'right' => [$right1, $right2]
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckPermissionApi()
    {
        $value = $this->faker->word;
        $right = $this->faker->word;
        $target = new TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), $value
        );

        $this->api->checkPermission(
           $target, [$right]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckPermissionRequest>'
                        .'<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . AccountBy::NAME() . '">' . $value . '</urn1:target>'
                        .'<urn1:right>' . $right . '</urn1:right>'
                    .'</urn1:CheckPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
