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
 * BatchRequestInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface BatchRequestInterface extends RequestInterface
{
    /**
     * Add soap request.
     *
     * @param RequestInterface $request
     * @return EnvelopeInterface
     */
    function addRequest(RequestInterface $request): self;

    /**
     * Get soap requests.
     *
     * @return array
     */
    function getRequests(): array;
}