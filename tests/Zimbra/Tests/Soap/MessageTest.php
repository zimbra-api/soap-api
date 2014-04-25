<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Common\SimpleXML;
use Zimbra\Soap\Message;

/**
 * Testcase class for soap message.
 */
class MessageTest extends ZimbraTestCase
{
    public function testAddHeader()
    {
        $message = new Message;
        $headers = array(
            'testName' => 'otherValue',
            'anotherName' => 'anotherValue',
        );

        $message->addHeader('testName', 'testValue');
        $this->assertSame('testValue', $message->header('testName'));

        $message->addHeader($headers);
        $this->assertSame('otherValue', $message->header('testName'));
        $this->assertSame($headers, $message->header());
    }

    public function testVersion()
    {
        $message = new Message;
        $this->assertSame('1.2', $message->version());

        $message = new Message(Message::SOAP_1_1);
        $this->assertSame('1.1', $message->version());
    }

    public function testContentType()
    {
        $message = new Message;
        $this->assertSame('text/xml; charset=utf-8', $message->contentType(Message::SOAP_1_1));
        $this->assertSame('application/soap+xml; charset=utf-8', $message->contentType(Message::SOAP_1_2));
    }

    public function testRequest()
    {
        $request = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $message = new Message;
        $message->request($request);
        $this->assertEquals($request, $message->request());
    }

    public function testToString()
    {
        $request = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $request->property('foo', 'foo');
        $request->child('bar', 'bar');

        $authToken = md5('authToken');
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" '
                         .'xmlns:urn="urn:zimbra">'
                .'<env:Header>'
                    .'<urn:context>'
                        .'<urn:authToken>'.$authToken.'</urn:authToken>'
                    .'</urn:context>'
                .'</env:Header>'
                .'<env:Body>'
                    .'<urn:'. $request->requestName() .' foo="foo">'
                        .'<urn:bar>bar</urn:bar>'
                    .'</urn:'. $request->requestName() .'>'
                .'</env:Body>'
            .'</env:Envelope>';
        $message = new Message;
        $message->addHeader('authToken', $authToken);
        $message->request($request);
        $this->assertXmlStringEqualsXmlString($xml, (string) $message);

        $json = '{'
		    .'"Header":{'
			    .'"context":{'
			        .'"_jsns":"urn:zimbra",'
			        .'"authToken":"'.$authToken.'"'
			    .'}'
		    .'},'
		    .'"Body":{'
		        .'"'. $request->requestName() .'":{'
		            .'"_jsns":"urn:zimbra",'
		            .'"foo":"foo",'
		            .'"bar":"bar"'
		        .'}'
		    .'}'
        .'}';
        $this->assertEquals($json, $message->toJson());
    }
}
