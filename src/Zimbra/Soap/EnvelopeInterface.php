<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

/**
 * BodyInterface is a interface which define soap envelope struct
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
interface EnvelopeInterface
{
    /**
     * Gets soap message header
     *
     * @return Header
     */
    function getHeader(): ?Header;

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    function getBody(): ?BodyInterface;
}
