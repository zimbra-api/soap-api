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
 * ApiInterface interface
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
interface ApiInterface
{
    /**
     * Invoke the request.
     *
     * @return  ResponseInterface
     */
    protected function invoke(RequestInterface $request): ?ResponseInterface;

    /**
     * Perform a batch request.
     *
     * @param  array $requests
     * @return ResponseInterface
     */
    public function batch(array $requests = []): ?ResponseInterface;
}
