<?php
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
 * BodyInterface is a interface which define soap body struct
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface BodyInterface
{
    /**
     * Set the request.
     *
     * @return  BodyInterface
     */
    function setRequest(RequestInterface $request);

    /**
     * Get the request.
     *
     * @return  RequestInterface
     */
    function getRequest();

    /**
     * Set the response.
     *
     * @return  ResponseInterface
     */
    function setResponse(ResponseInterface $response);

    /**
     * Get the response.
     *
     * @return  ResponseInterface
     */
    function getResponse();
}
