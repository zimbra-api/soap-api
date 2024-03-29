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
 * SoapEnvelopeInterface is a interface which define soap envelope struct
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface SoapEnvelopeInterface
{
    /**
     * Get soap header message
     *
     * @return SoapHeaderInterface
     */
    function getHeader(): ?SoapHeaderInterface;

    /**
     * Set soap header message
     *
     * @param  SoapHeaderInterface $header
     * @return self
     */
    function setHeader(SoapHeaderInterface $header): self;

    /**
     * Get soap body message
     *
     * @return SoapBodyInterface
     */
    function getBody(): ?SoapBodyInterface;

    /**
     * Set soap body message
     *
     * @param  SoapBodyInterface $body
     * @return self
     */
    function setBody(SoapBodyInterface $body): self;
}
