<?php

namespace Zimbra\Soap\Tests;

use GuzzleHttp\Psr7\Response as HttpResponse;
use GuzzleHttp\Psr7;
use Zimbra\Soap\Response;

/**
 * Testcase class for soap client.
 */
class ResponseTest extends ZimbraSoapTestCase
{
    public function testResponse()
    {
        $authToken = $this->faker->sha1;
        $lifetime = mt_rand();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
                .'<soap:Header>'
                    .'<context xmlns="urn:zimbra">'
                        .'<change token="13696"/>'
                    .'</context>'
                .'</soap:Header>'
                .'<soap:Body>'
                    .'<AuthResponse xmlns="urn:zimbraAccount">'
                        .'<authToken>' . $authToken . '</authToken>'
                        .'<lifetime>' . $lifetime . '</lifetime>'
                        .'<skin>serenity</skin>'
                    .'</AuthResponse>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        $response = new Response(new HttpResponse(200, [], Psr7\stream_for($xml)));
        $this->assertSame($authToken, $response->authToken);
        $this->assertSame($lifetime, (int) $response->lifetime);
        $this->assertSame('serenity', $response->skin);
    }
}
