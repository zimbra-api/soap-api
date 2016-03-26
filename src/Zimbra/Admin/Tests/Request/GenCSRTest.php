<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GenCSR;
use Zimbra\Enum\CSRKeySize;
use Zimbra\Enum\CSRType;

/**
 * Testcase class for GenCSR.
 */
class GenCSRTest extends ZimbraAdminApiTestCase
{
    public function testGenCSRRequest()
    {
        $server = $this->faker->word;
        $digest = $this->faker->word;
        $c = $this->faker->word;
        $st = $this->faker->word;
        $l = $this->faker->word;
        $o = $this->faker->word;
        $ou = $this->faker->word;
        $cn = $this->faker->word;
        $subject1 = $this->faker->word;
        $subject2 = $this->faker->word;

        $req = new GenCSR(
            $server, false, CSRType::SELF(), $digest, CSRKeySize::SIZE_1024(), $c, $st, $l, $o, $ou, $cn, [$subject1]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertFalse($req->getNewCSR());
        $this->assertSame('self', $req->getType()->value());
        $this->assertSame($digest, $req->getDigest());
        $this->assertSame(1024, $req->getKeySize()->value());
        $this->assertSame($c, $req->getC());
        $this->assertSame($st, $req->getSt());
        $this->assertSame($l, $req->getL());
        $this->assertSame($o, $req->getO());
        $this->assertSame($ou, $req->getOu());
        $this->assertSame($cn, $req->getCn());
        $this->assertSame([$subject1], $req->getSubjectAltNames()->all());

        $req->setServer($server)
            ->setNewCSR(true)
            ->setType(CSRType::COMM())
            ->setDigest($digest)
            ->setKeySize(CSRKeySize::SIZE_2048())
            ->setC($c)
            ->setSt($st)
            ->setL($l)
            ->setO($o)
            ->setOu($ou)
            ->setCn($cn)
            ->addSubjectAltName($subject2);
        $this->assertSame($server, $req->getServer());
        $this->assertTrue($req->getNewCSR());
        $this->assertSame('comm', $req->getType()->value());
        $this->assertSame($digest, $req->getDigest());
        $this->assertSame(2048, $req->getKeySize()->value());
        $this->assertSame($c, $req->getC());
        $this->assertSame($st, $req->getSt());
        $this->assertSame($l, $req->getL());
        $this->assertSame($o, $req->getO());
        $this->assertSame($ou, $req->getOu());
        $this->assertSame($cn, $req->getCn());
        $this->assertSame([$subject1, $subject2], $req->getSubjectAltNames()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GenCSRRequest server="' . $server . '" new="true" type="' . CSRType::COMM() . '" digest="' . $digest . '" keysize="' . CSRKeySize::SIZE_2048() . '">'
                . '<C>' . $c . '</C>'
                . '<ST>' . $st . '</ST>'
                . '<L>' . $l . '</L>'
                . '<O>' . $o . '</O>'
                . '<OU>' . $ou . '</OU>'
                . '<CN>' . $cn . '</CN>'
                . '<SubjectAltName>' . $subject1 . '</SubjectAltName>'
                . '<SubjectAltName>' . $subject2 . '</SubjectAltName>'
            . '</GenCSRRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GenCSRRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'new' => true,
                'type' => CSRType::COMM()->value(),
                'digest' => $digest,
                'keysize' => CSRKeySize::SIZE_2048()->value(),
                'C' => $c,
                'ST' => $st,
                'L' => $l,
                'O' => $o,
                'OU' => $ou,
                'CN' => $cn,
                'SubjectAltName' => [
                    $subject1,
                    $subject2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGenCSRApi()
    {
        $server = $this->faker->word;
        $digest = $this->faker->word;
        $c = $this->faker->word;
        $st = $this->faker->word;
        $l = $this->faker->word;
        $o = $this->faker->word;
        $ou = $this->faker->word;
        $cn = $this->faker->word;
        $subject = $this->faker->word;

        $this->api->genCSR(
            $server, true, CSRType::COMM(), $digest, CSRKeySize::SIZE_2048(), $c, $st, $l, $o, $ou, $cn, [$subject]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GenCSRRequest server="' . $server . '" new="true" type="' . CSRType::COMM() . '" digest="' . $digest . '" keysize="' . CSRKeySize::SIZE_2048() . '">'
                        . '<urn1:C>' . $c . '</urn1:C>'
                        . '<urn1:ST>' . $st . '</urn1:ST>'
                        . '<urn1:L>' . $l . '</urn1:L>'
                        . '<urn1:O>' . $o . '</urn1:O>'
                        . '<urn1:OU>' . $ou . '</urn1:OU>'
                        . '<urn1:CN>' . $cn . '</urn1:CN>'
                        . '<urn1:SubjectAltName>' . $subject . '</urn1:SubjectAltName>'
                    . '</urn1:GenCSRRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
