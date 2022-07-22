<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * ClientInterface is a interface which provides a client for SOAP servers
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ClientInterface
{
    /**
     * Performs a SOAP request
     *
     * @param  string $soapMessage Soap message
     * @param  array $headers Request headers
     * @return ResponseInterface
     */
    function sendRequest(string $soapMessage, array $headers = []): ?ResponseInterface;

    /**
     * Returns last request.
     *
     * @return RequestInterface
     */
    function getLastRequest(): ?RequestInterface;

    /**
     * Returns last response.
     *
     * @return ResponseInterface
     */
    function getLastResponse(): ?ResponseInterface;
}
