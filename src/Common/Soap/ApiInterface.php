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

use Zimbra\Common\Struct\{
    SoapHeaderInterface,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * Api interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ApiInterface
{
    /**
     * Invoke the soap request.
     *
     * @param  SoapRequestInterface $request
     * @return SoapResponseInterface
     */
    function invoke(SoapRequestInterface $request): ?SoapResponseInterface;

    /**
     * Get the soap request header.
     *
     * @return SoapHeaderInterface
     */
    function getRequestHeader(): ?SoapHeaderInterface;

    /**
     * Get the soap response header.
     *
     * @return SoapHeaderInterface
     */
    function getResponseHeader(): ?SoapHeaderInterface;

    /**
     * Get soap client.
     *
     * @return ClientInterface
     */
    function getClient(): ClientInterface;
}
