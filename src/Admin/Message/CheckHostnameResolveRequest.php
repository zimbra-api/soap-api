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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckHostnameResolveRequest request class
 * Check whether a hostname can be resolved
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckHostnameResolveRequest extends SoapRequest
{
    /**
     * Hostname
     * 
     * @var string
     */
    #[Accessor(getter: 'getHostname', setter: 'setHostname')]
    #[SerializedName(name: 'hostname')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $hostname;

    /**
     * Constructor
     * 
     * @param  string $hostname
     * @return self
     */
    public function __construct(?string $hostname = NULL)
    {
        if (NULL !== $hostname) {
	        $this->setHostname($hostname);
        }
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    /**
     * Set hostname
     *
     * @param  string $hostname
     * @return self
     */
    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckHostnameResolveEnvelope(
            new CheckHostnameResolveBody($this)
        );
    }
}
