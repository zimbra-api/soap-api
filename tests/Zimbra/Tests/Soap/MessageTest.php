<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Message;
use Zimbra\Common\SimpleXML;

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

        $message = new Message(NULL, Message::SOAP_1_1);
        $this->assertSame('1.1', $message->version());
    }

    public function testContentType()
    {
        $message = new Message;
        $this->assertSame('text/xml; charset=utf-8', $message->contentType(Message::SOAP_1_1));
        $this->assertSame('application/soap+xml; charset=utf-8', $message->contentType(Message::SOAP_1_2));
    }

    public function testBody()
    {
        $request = new SimpleXML('<Request />');
        $params = array(
            'param0' => 'Hello',
            'param1' => array(
                'title' => 'Mr',
                '_' => 'Test',
            )
        );
        $request->addArray($params);

        $message = new Message;
        $message->body($request);
        $bodyXml = str_replace('urn:', '', $message->body()->asXml());

        $this->assertXmlStringEqualsXmlString($request->asXml(), $bodyXml);
    }

    public function testToString()
    {
        $authToken = md5('authToken');
        $request = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" '
                         .'xmlns:urn="urn:zimbra" '
                         .'xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Header>'
                    .'<urn:context>'
                        .'<urn:authToken>'.$authToken.'</urn:authToken>'
                    .'</urn:context>'
                .'</env:Header>'
                .'<env:Body>'
                    .'<urn1:Request echo="1">'
                        .'<urn1:param0>Hello</urn1:param0>'
                        .'<urn1:param1 title="Mr">Test</urn1:param1>'
                    .'</urn1:Request>'
                .'</env:Body>'
            .'</env:Envelope>';
        $message = new Message('urn:zimbraAdmin');
        $message->addHeader('authToken', $authToken);
        $body = new SimpleXML('<Request />');
        $body->addAttribute('echo', '1');
        $params = array(
            'param0' => 'Hello',
            'param1' => array(
                'title' => 'Mr',
                '_' => 'Test',
            )
        );
        $body->addArray($params);
        $message->body($body);
        $this->assertXmlStringEqualsXmlString($request, (string) $message);
    }
}
