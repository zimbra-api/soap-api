<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\CreateTask;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for CreateTask.
 */
class CreateTaskTest extends ZimbraMailApiTestCase
{
    public function testCreateTaskRequest()
    {
        $max = mt_rand(1, 10);
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $m = new Msg(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );

        $req = new CreateTask(
            $m, true, $max, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\CreateTask', $req);
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getEcho());
        $this->assertSame($max, $req->getMaxSize());
        $this->assertTrue($req->getWantHtml());
        $this->assertTrue($req->getNeuter());
        $this->assertTrue($req->getForceSend());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTaskRequest echo="true" max="' . $max . '" html="true" neuter="true" forcesend="true">'
                .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</CreateTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTaskRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'echo' => true,
                'max' => $max,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
                'm' => array(
                    'aid' => $aid,
                    'origid' => $origid,
                    'rt' => ReplyType::REPLIED()->value(),
                    'idnt' => $idnt,
                    'su' => $su,
                    'irt' => $irt,
                    'l' => $l,
                    'f' => $f,
                    'content' => $content,
                    'fr' => $fr,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTaskApi()
    {
        $max = mt_rand(1, 10);
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $m = new Msg(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );

        $this->api->createTask(
            $m, true, $max, true, true, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateTaskRequest echo="true" max="' . $max . '" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:CreateTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
