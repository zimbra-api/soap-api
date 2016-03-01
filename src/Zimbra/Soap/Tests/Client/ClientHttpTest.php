<?php

namespace Zimbra\Soap\Tests\Client;

use Zimbra\Soap\Tests\ZimbraSoapTestCase;
use Zimbra\Soap\Request;

/**
 * Testcase class for soap client.
 */
class ClientHttpTest extends ZimbraSoapTestCase
{
    public function testHttp()
    {
        $authToken = $this->faker->sha1;
        $sessionId = $this->faker->sha1;
        $client = new LocalClientHttp(NULL);
        $client->setAuthToken($authToken)
               ->setSessionId($sessionId);
        $this->assertSame($authToken, $client->getAuthToken());
        $this->assertSame($sessionId, $client->getSessionId());
        $lastRequest = '';
        $client->on('before.request', function($request) use (&$lastRequest)
        {
            $lastRequest = $request;
        });

        $request = new Test('foo', 'bar');
        $response = $client->doRequest($request);
        $this->assertSame('foo', $response->foo);
        $this->assertSame('bar', $response->bar);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra">'
                .'<env:Header>'
                    .'<urn:context><urn:authToken>' . $authToken . '</urn:authToken><urn:sessionId>' . $sessionId . '</urn:sessionId></urn:context>'
                .'</env:Header>'
                .'<env:Body>'
                    .'<urn:TestRequest><urn:foo>foo</urn:foo><urn:bar>bar</urn:bar></urn:TestRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $lastRequest);
    }
}

class Test extends Request
{
    private $foo;
    private $bar;

    public function __construct($foo, $bar)
    {
        parent::__construct();
        $this->setChild('foo', trim($foo));
        $this->setChild('bar', trim($bar));
    }

    public function foo($foo = NULL)
    {
        if(NULL === $foo)
        {
            return $this->getChild('foo');
        }
        return $this->setChild('foo', trim($foo));
    }

    public function bar($bar = NULL)
    {
        if(NULL === $bar)
        {
            return $this->getChild('bar');
        }
        return $this->setChild('bar', trim($bar));
    }
}
