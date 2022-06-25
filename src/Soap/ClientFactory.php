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

use Psr\Http\Client\ClientInterface as HttpClient;
use Psr\Http\Message\{RequestFactoryInterface, StreamFactoryInterface};
use Http\Discovery\{Psr17FactoryDiscovery, Psr18ClientDiscovery};

/**
 * Factory for client instances.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2021 by Nguyen Van Nguyen.
 */
final class ClientFactory
{
    public static function create(
        string $serviceUrl,
        ?HttpClient $httpClient = NULL,
        ?RequestFactoryInterface $requestFactory = NULL,
        ?StreamFactoryInterface $streamFactory = NULL
    ): ClientInterface
    {
        return new Client(
            $serviceUrl,
            $httpClient ?: Psr18ClientDiscovery::find(),
            $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory(),
            $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory()
        );
    }
}
