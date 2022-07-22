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

/**
 * ApiInterface interface
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
     * @param  RequestInterface $request
     * @return ResponseInterface
     */
    function invoke(RequestInterface $request): ?ResponseInterface;

    /**
     * Get the soap request header.
     *
     * @return Header
     */
    function getRequestHeader(): ?Header;

    /**
     * Get the soap response header.
     *
     * @return Header
     */
    function getResponseHeader(): ?Header;
}
