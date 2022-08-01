<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

/**
 * BatchRequestInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface BatchRequestInterface extends SoapRequestInterface
{
    /**
     * Add a soap request
     *
     * @param  SoapRequestInterface $request
     * @return self
     */
    function addRequest(SoapRequestInterface $request): self;

    /**
     * Get soap requests
     *
     * @return array
     */
    function getRequests(): array;
}