<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Client\Http;
use Zimbra\Soap\Client\Wsdl;
use \SoapServer;

/**
 * Testcase class for soap client.
 */
class ClientTest extends ZimbraTestCase
{
    public function testWsdl()
    {
        $client = new Wsdl(__DIR__.'/../TestData/test.wsdl');
        $client->authToken('authToken')
               ->sessionId('sessionId');
        $this->assertSame('authToken', $client->authToken());
        $this->assertSame('sessionId', $client->sessionId());
        $this->assertInstanceOf('\SoapHeader', $client->soapHeader());
    }

    /**
     * @outputBuffering enabled
     */
    public function testWsdlRequest()
    {
        if (headers_sent($file, $line))
        {
            $this->markTestSkipped('Cannot run testWsdl() when headers have already been sent. Output started in '.$file.'@'.$line.' enable output buffering to run this test');
            return;
        }
        $server = new SoapServer(__DIR__.'/../TestData/test.wsdl');
        $server->setClass('\Zimbra\Tests\TestData\TestRequestServer');
        $this->assertContains('testRequest', $server->getFunctions());

        $client = new LocalClientWsdl($server, __DIR__.'/../TestData/test.wsdl');
        $request = new \Zimbra\Tests\TestData\Test('foo', 'bar');
        $params = $request->toArray();
        $client->__soapCall($request->requestName(), $params[$request->requestName()]);
    }

    public function testHttp()
    {
        $client = new LocalClientHttp(NULL);
        $client->authToken('authToken')
               ->sessionId('sessionId');
        $this->assertSame('authToken', $client->authToken());
        $this->assertSame('sessionId', $client->sessionId());

        $request = new \Zimbra\Tests\TestData\Test('foo', 'bar');
        $result = $client->doRequest($request);
        $this->assertObjectHasAttribute('foo', $result);
        $this->assertObjectHasAttribute('bar', $result);
    }
}

class LocalClientWsdl extends Wsdl
{
    private $_server;

    public function __construct(SoapServer $server, $location, $namespace = 'urn:zimbra')
    {
        parent::__construct($location, $namespace);
        $this->_server = $server;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        ob_start();
        $this->_server->handle($request);
        $response = ob_get_clean();
        return $response;
    }
}

class LocalClientHttp extends Http
{
    public function __doRequest($request, array $headers = array())
    {
        $this->headers = $headers;
        $response = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/soap-encoding">'
                .'<soap:Body xmlns:rpc="http://www.w3.org/2003/05/soap-rpc">'
                    .'<TestResponse>'
                        .'<foo>foo</foo>'
                        .'<bar>bar</bar>'
                    .'</TestResponse>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        return $response;
    }
}