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

use PsrDiscovery\Discover;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\{RequestFactoryInterface, StreamFactoryInterface};

/**
 * Factory for client instances.
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
final class ClientFactory
{
    /**
     * Create the Zimbra SOAP client.
     *
     * @param string $serviceUrl
     * @param HttpClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @return ClientInterface
     */
    public static function create(
        string $serviceUrl,
        ?HttpClientInterface $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface $streamFactory = null
    ): ClientInterface {
        return new Client(
            $serviceUrl,
            $httpClient ?? Discover::httpClient(),
            $requestFactory ?? Discover::httpRequestFactory(),
            $streamFactory ?? Discover::httpStreamFactory()
        );
    }
}
