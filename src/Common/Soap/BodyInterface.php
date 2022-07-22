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
 * BodyInterface is a interface which define soap body struct
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface BodyInterface
{
    /**
     * Get the request.
     *
     * @return  RequestInterface
     */
    function getRequest(): ?RequestInterface;

    /**
     * Get the response.
     *
     * @return  ResponseInterface
     */
    function getResponse(): ?ResponseInterface;
}
