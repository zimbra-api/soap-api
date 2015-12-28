<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeployZimlet;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Enum\DeployZimletAction as DeployAction;

/**
 * Testcase class for DeployZimlet.
 */
class DeployZimletTest extends ZimbraAdminApiTestCase
{
    public function testDeployZimletRequest()
    {
        $aid = $this->faker->word;
        $content = new AttachmentIdAttrib($aid);
        $req = new DeployZimlet(DeployAction::DEPLOY_ALL(), $content, false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('deployAll', $req->getAction()->value());
        $this->assertSame($content, $req->getContent());
        $this->assertFalse($req->getFlushCache());
        $this->assertTrue($req->getSynchronous());

        $req->setAction(DeployAction::DEPLOY_LOCAL())
            ->setContent($content)
            ->setFlushCache(true)
            ->setSynchronous(false);
        $this->assertSame('deployLocal', $req->getAction()->value());
        $this->assertSame($content, $req->getContent());
        $this->assertTrue($req->getFlushCache());
        $this->assertFalse($req->getSynchronous());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeployZimletRequest action="' . DeployAction::DEPLOY_LOCAL()  .'" flush="true" synchronous="false">'
                . '<content aid="' . $aid .'" />'
            . '</DeployZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeployZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => DeployAction::DEPLOY_LOCAL()->value(),
                'flush' => true,
                'synchronous' => false,
                'content' => [
                    'aid' => $aid,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeployZimletApi()
    {
        $aid = $this->faker->word;
        $content = new AttachmentIdAttrib($aid);

        $this->api->deployZimlet(
            DeployAction::DEPLOY_LOCAL(), $content, true, false
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeployZimletRequest action="' . DeployAction::DEPLOY_LOCAL() . '" flush="true" synchronous="false">'
                        . '<urn1:content aid="' . $aid . '" />'
                    . '</urn1:DeployZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
