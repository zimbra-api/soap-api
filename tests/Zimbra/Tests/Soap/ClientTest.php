<?php

namespace Zimbra\Tests\Soap;

use \SoapServer;
use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Request;

/**
 * Testcase class for soap client.
 */
class ClientTest extends ZimbraTestCase
{
    public function testHttp()
    {
        $client = new LocalClientHttp(NULL);
        $client->authToken('authToken')
               ->sessionId('sessionId');
        $this->assertSame('authToken', $client->authToken());
        $this->assertSame('sessionId', $client->sessionId());
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
                    .'<urn:context><urn:authToken>authToken</urn:authToken><urn:sessionId>sessionId</urn:sessionId></urn:context>'
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
        $this->child('foo', trim($foo));
        $this->child('bar', trim($bar));
    }

    public function foo($foo = NULL)
    {
        if(NULL === $foo)
        {
            return $this->child('foo');
        }
        return $this->child('foo', trim($foo));
    }

    public function bar($bar = NULL)
    {
        if(NULL === $bar)
        {
            return $this->child('bar');
        }
        return $this->child('bar', trim($bar));
    }
}