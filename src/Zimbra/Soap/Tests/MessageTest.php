<?php

namespace Zimbra\Soap\Tests;

use Zimbra\Common\SimpleXML;
use Zimbra\Soap\Message;

/**
 * Testcase class for soap message.
 */
class MessageTest extends ZimbraSoapTestCase
{
    public function testAddHeader()
    {
        $testName = $this->faker->word;
        $testValue = $this->faker->word;
        $anotherName = $this->faker->word;
        $anotherValue = $this->faker->word;

        $message = new Message;
        $headers = [
            $testName => $testValue,
            $anotherName => $anotherValue,
        ];

        $message->addHeader($testName, $testValue);
        $this->assertSame($testValue, $message->getHeader($testName));

        $message->addHeader($headers);
        $this->assertSame($anotherValue, $message->getHeader($anotherName));
        $this->assertSame($headers, $message->getHeaders());
    }

    public function testVersion()
    {
        $message = new Message;
        $this->assertSame('1.2', $message->getVersion());

        $message = new Message(Message::SOAP_1_1);
        $this->assertSame('1.1', $message->getVersion());
    }

    public function testContentType()
    {
        $message = new Message;
        $this->assertSame('text/xml; charset=utf-8', $message->getContentType(Message::SOAP_1_1));
        $this->assertSame('application/soap+xml; charset=utf-8', $message->getContentType(Message::SOAP_1_2));
    }

    public function testRequest()
    {
        $request = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $message = new Message;
        $message->setRequest($request);
        $this->assertEquals($request, $message->getRequest());
    }

    public function testToString()
    {
        $foo = $this->faker->word;
        $bar = $this->faker->word;
        $request = $this->getMockForAbstractClass('\Zimbra\Soap\Request');
        $request->setProperty('foo', $foo);
        $request->setChild('bar', $bar);

        $authToken = $this->faker->sha1;
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" '
                         .'xmlns:urn="urn:zimbra">'
                .'<env:Header>'
                    .'<urn:context>'
                        .'<urn:authToken>'.$authToken.'</urn:authToken>'
                    .'</urn:context>'
                .'</env:Header>'
                .'<env:Body>'
                    .'<urn:'. $request->requestName() .' foo="' . $foo . '">'
                        .'<urn:bar>' . $bar . '</urn:bar>'
                    .'</urn:'. $request->requestName() .'>'
                .'</env:Body>'
            .'</env:Envelope>';
        $message = new Message;
        $message->addHeader('authToken', $authToken);
        $message->setRequest($request);
        $this->assertXmlStringEqualsXmlString($xml, (string) $message);

        $json = '{'
            .'"Header":{'
                .'"context":{'
                    .'"_jsns":"urn:zimbra",'
                    .'"authToken":{"_content":"'.$authToken.'"}'
                .'}'
            .'},'
            .'"Body":{'
                .'"'. $request->requestName() .'":{'
                    .'"_jsns":"urn:zimbra",'
                    .'"foo":"' . $foo . '",'
                    .'"bar":"' . $bar . '"'
                .'}'
            .'}'
        .'}';
        $this->assertEquals($json, $message->toJson());
    }
}
