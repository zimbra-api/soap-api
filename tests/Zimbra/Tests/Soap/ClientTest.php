<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use \SoapServer;

/**
 * Testcase class for soap client.
 */
class ClientTest extends ZimbraTestCase
{
    public function testWsdl()
    {
        $client = new LocalClientWsdl(__DIR__.'/../TestData/test.wsdl');
        $lastRequest = '';
        $client->on('before.request', function($request) use (&$lastRequest)
        {
            $lastRequest = $request;
        });

        $client->authToken('authToken')
               ->sessionId('sessionId');
        $this->assertSame('authToken', $client->authToken());
        $this->assertSame('sessionId', $client->sessionId());
        $this->assertInstanceOf('\SoapHeader', $client->soapHeader());

        $request = new \Zimbra\Tests\TestData\Test('foo', 'bar');
        $params = $request->toArray();
        $client->__soapCall($request->requestName(), $params[$request->requestName()]);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbra" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/soap-encoding">'
                .'<env:Body>'
                    .'<ns1:testRequest env:encodingStyle="http://www.w3.org/2003/05/soap-encoding">'
                        .'<foo xsi:type="xsd:string">foo</foo><bar xsi:type="xsd:string">bar</bar>'
                    .'</ns1:testRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $lastRequest);
    }

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

        $request = new \Zimbra\Tests\TestData\Test('foo', 'bar');
        $result = $client->doRequest($request);
        $this->assertObjectHasAttribute('foo', $result);
        $this->assertObjectHasAttribute('bar', $result);

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
