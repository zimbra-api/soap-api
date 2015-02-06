<?php

namespace Zimbra\Tests\Soap;

use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Zimbra\Soap\Client\Http as ClientHttp;

class LocalClientHttp extends ClientHttp
{
    public function __doRequest($request, array $headers = array())
    {
        $this->headers = $headers;
        $this->emit('before.request', array(&$request, &$headers));
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/soap-encoding">'
                .'<soap:Body xmlns:rpc="http://www.w3.org/2003/05/soap-rpc">'
                    .'<TestResponse>'
                        .'<foo>foo</foo>'
                        .'<bar>bar</bar>'
                    .'</TestResponse>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        $stream = Stream::factory($xml);
        return new Response(200, array(), $stream);
    }
}
