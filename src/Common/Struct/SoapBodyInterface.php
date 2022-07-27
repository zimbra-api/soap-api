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
 * SoapBodyInterface is a interface which define soap body struct
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface SoapBodyInterface
{
    /**
     * Get the soap request message.
     *
     * @return SoapRequestInterface
     */
    function getRequest(): ?SoapRequestInterface;

    /**
     * Get the soap response message.
     *
     * @return SoapResponseInterface
     */
    function getResponse(): ?SoapResponseInterface;

    /**
     * Get the soap fault.
     *
     * @return  SoapFaultInterface
     */
    function getSoapFault(): ?SoapFaultInterface;
}
