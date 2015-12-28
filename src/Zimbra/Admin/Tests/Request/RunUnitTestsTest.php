<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RunUnitTests;

/**
 * Testcase class for RunUnitTests.
 */
class RunUnitTestsTest extends ZimbraAdminApiTestCase
{
    public function testRunUnitTestsRequest()
    {
        $test1 = $this->faker->word;
        $test2 = $this->faker->word;

        $req = new RunUnitTests([$test1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals([$test1], $req->getTests()->all());
        $req->addTest($test2);
        $this->assertEquals([$test1, $test2], $req->getTests()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RunUnitTestsRequest>'
                . '<test>' . $test1 . '</test>'
                . '<test>' . $test2 . '</test>'
            . '</RunUnitTestsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RunUnitTestsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'test' => [
                    $test1,
                    $test2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRunUnitTestsApi()
    {
        $test1 = $this->faker->word;
        $test2 = $this->faker->word;
        $this->api->runUnitTests([$test1, $test2]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RunUnitTestsRequest>'
                        . '<urn1:test>' . $test1 . '</urn1:test>'
                        . '<urn1:test>' . $test2 . '</urn1:test>'
                    . '</urn1:RunUnitTestsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
