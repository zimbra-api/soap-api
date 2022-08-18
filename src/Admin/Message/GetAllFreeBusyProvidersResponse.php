<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\FreeBusyProviderInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllFreeBusyProvidersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllFreeBusyProvidersResponse extends SoapResponse
{
    /**
     * Information on Free/Busy providers
     * 
     * @Accessor(getter="getProviders", setter="setProviders")
     * @Type("array<Zimbra\Admin\Struct\FreeBusyProviderInfo>")
     * @XmlList(inline=true, entry="provider", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getProviders', setter: 'setProviders')]
    #[Type('array<Zimbra\Admin\Struct\FreeBusyProviderInfo>')]
    #[XmlList(inline: true, entry: 'provider', namespace: 'urn:zimbraAdmin')]
    private $providers = [];

    /**
     * Constructor
     *
     * @param array $providers
     * @return self
     */
    public function __construct(array $providers = [])
    {
        $this->setProviders($providers);
    }

    /**
     * Set providers
     *
     * @param  array $providers
     * @return self
     */
    public function setProviders(array $providers): self
    {
        $this->providers = array_filter($providers, static fn ($provider) => $provider instanceof FreeBusyProviderInfo);
        return $this;
    }

    /**
     * Get providers
     *
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}
