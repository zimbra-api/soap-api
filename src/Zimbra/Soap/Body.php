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
 * Soap body class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class Body implements BodyInterface
{
    /**
     * Constructor method for Body
     * @return self
     */
    public function __construct(RequestInterface $request = NULL, ResponseInterface $response = NULL)
    {
        if ($request instanceof RequestInterface) {
            $this->setRequest($request);
        }
        if ($response instanceof ResponseInterface) {
            $this->setResponse($response);
        }
    }

    /**
     * Set the request.
     *
     * @param  RequestInterface $request
     * @return self
     */
    abstract public function setRequest(RequestInterface $request): self;


    /**
     * Set the response.
     *
     * @param  ResponseInterface $response
     * @return self
     */
    abstract public function setResponse(ResponseInterface $response): self;
}
