<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Client;

use Zimbra\Soap\Request as SoapRequest;

/**
 * ClientInterface is a interface which provides a client for SOAP servers
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface ClientInterface
{
    /**
     * Gets authentication token.
     *
     * @return string
     */
    function getAuthToken();

    /**
     * Sets authentication token.
     *
     * @param  string $authToken Authentication token
     * @return self
     */
    function setAuthToken($authToken);

    /**
     * Gets authentication session identify.
     *
     * @return string
     */
    function getSessionId();

    /**
     * Sets authentication session identify.
     *
     * @param  string $sessionId Authentication session identify
     * @return self
     */
    function setSessionId($sessionId);

    /**
     * Performs a SOAP request
     *
     * @param  Zimbra\Soap\Request $request
     * @return object Soap response
     */
    function doRequest(SoapRequest $request);

    /**
     * Returns last SOAP request.
     *
     * @return string The last SOAP request, as an XML string.
     */
    function lastRequest();

    /**
     * Returns the SOAP headers from the last request.
     *
     * @return array The last SOAP request headers.
     */
    function lastRequestHeaders();

    /**
     * Returns last SOAP response.
     *
     * @return string The last SOAP response, as an XML string.
     */
    function lastResponse();

    /**
     * Returns the SOAP headers from the last response.
     *
     * @return array The last SOAP response headers.
     */
    function lastResponseHeaders();
}
