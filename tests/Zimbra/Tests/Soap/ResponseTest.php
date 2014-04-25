<?php

namespace Zimbra\Tests\Soap;

use Guzzle\Http\Message\Response as HttpResponse;
use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Soap\Response;

/**
 * Testcase class for soap client.
 */
class ResponseTest extends ZimbraTestCase
{
    public function testResponse()
    {
        $xml = '<?xml version="1.0"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
                .'<soap:Header>'
                    .'<context xmlns="urn:zimbra">'
                        .'<change token="13696"/>'
                    .'</context>'
                .'</soap:Header>'
                .'<soap:Body>'
                    .'<AuthResponse xmlns="urn:zimbraAccount">'
                        .'<authToken>104cd8b8592b911f6a9c6705f560f3d698c51be2</authToken>'
                        .'<lifetime>172800000</lifetime>'
                        .'<skin>serenity</skin>'
                    .'</AuthResponse>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        $response = new Response(new HttpResponse(200, array(), $xml));
        $this->assertSame('104cd8b8592b911f6a9c6705f560f3d698c51be2', $response->authToken);
        $this->assertSame('172800000', $response->lifetime);
        $this->assertSame('serenity', $response->skin);
    }
}