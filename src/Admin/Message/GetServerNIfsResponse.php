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
use Zimbra\Admin\Struct\NetworkInformation;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetServerNIfsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetServerNIfsResponse extends SoapResponse
{
    /**
     * Network interface information
     * 
     * @Accessor(getter="getNetworkInterfaces", setter="setNetworkInterfaces")
     * @Type("array<Zimbra\Admin\Struct\NetworkInformation>")
     * @XmlList(inline=true, entry="ni", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getNetworkInterfaces', setter: 'setNetworkInterfaces')]
    #[Type(name: 'array<Zimbra\Admin\Struct\NetworkInformation>')]
    #[XmlList(inline: true, entry: 'ni', namespace: 'urn:zimbraAdmin')]
    private $networkInterfaces = [];

    /**
     * Constructor
     *
     * @param array $networkInterfaces
     * @return self
     */
    public function __construct(array $networkInterfaces = [])
    {
        $this->setNetworkInterfaces($networkInterfaces);
    }

    /**
     * Set network informations
     *
     * @param  array $interfaces
     * @return self
     */
    public function setNetworkInterfaces(array $interfaces): self
    {
        $this->networkInterfaces = array_filter($interfaces, static fn ($ni) => $ni instanceof NetworkInformation);
        return $this;
    }

    /**
     * Get network informations
     *
     * @return array
     */
    public function getNetworkInterfaces(): array
    {
        return $this->networkInterfaces;
    }
}
