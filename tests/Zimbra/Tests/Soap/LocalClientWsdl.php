<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Common\SimpleXML;
use Zimbra\Soap\Client\Wsdl as ClientWsdl;

class LocalClientWsdl extends ClientWsdl
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
    	$xml = new SimpleXML($request);
        $response = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:enc="http://www.w3.org/2003/05/soap-encoding">'
                .'<soap:Body xmlns:rpc="http://www.w3.org/2003/05/soap-rpc">'
                    .'<RequestResponse>'
                        .'<foo>foo</foo>'
                        .'<bar>bar</bar>'
                    .'</RequestResponse>'
                .'</soap:Body>'
            .'</soap:Envelope>';
        return $response;
    }
}
