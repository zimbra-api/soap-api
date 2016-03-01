<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\CalItemRequestBase;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for CalItemRequestBase.
 */
class CalItemRequestBaseTest extends ZimbraMailApiTestCase
{
    public function testCalItemRequestBaseRequest()
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

        $req = $this->getMockForAbstractClass('\Zimbra\Mail\Request\CalItemRequestBase');

        $req->setMsg($m)
            ->setEcho(true)
            ->setMaxSize($max)
            ->setWantHtml(true)
            ->setNeuter(true)
            ->setForceSend(true);
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getEcho());
        $this->assertSame($max, $req->getMaxSize());
        $this->assertTrue($req->getWantHtml());
        $this->assertTrue($req->getNeuter());
        $this->assertTrue($req->getForceSend());
    }
}
