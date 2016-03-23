<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAlwaysOnCluster;
use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Enum\AlwaysOnClusterBy as ClusterBy;

/**
 * Testcase class for GetAlwaysOnCluster.
 */
class GetAlwaysOnClusterTest extends ZimbraAdminApiTestCase
{
    public function testGetAlwaysOnClusterRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $cluster = new AlwaysOnClusterSelector(ClusterBy::NAME(), $value);
        $req = new GetAlwaysOnCluster($cluster, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cluster, $req->getAlwaysOnCluster());

        $req->setAlwaysOnCluster($cluster);
        $this->assertSame($cluster, $req->getAlwaysOnCluster());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAlwaysOnClusterRequest attrs="' . $attrs . '">'
                . '<alwaysOnCluster by="' . ClusterBy::NAME() . '">' . $value . '</alwaysOnCluster>'
            . '</GetAlwaysOnClusterRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAlwaysOnClusterRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'alwaysOnCluster' => [
                    'by' => ClusterBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAlwaysOnClusterApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $cluster = new AlwaysOnClusterSelector(ClusterBy::NAME(), $value);

        $this->api->getAlwaysOnCluster($cluster, [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAlwaysOnClusterRequest attrs="' . $attrs . '">'
                        . '<urn1:alwaysOnCluster by="' . ClusterBy::NAME() . '">' . $value . '</urn1:alwaysOnCluster>'
                    . '</urn1:GetAlwaysOnClusterRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
