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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetAlwaysOnClusterRequest class
 * Get Server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAlwaysOnClusterRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Server
     *
     * @Accessor(getter="getAlwaysOnCluster", setter="setAlwaysOnCluster")
     * @SerializedName("alwaysOnCluster")
     * @Type("Zimbra\Admin\Struct\AlwaysOnClusterSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var AlwaysOnClusterSelector
     */
    #[Accessor(getter: "getAlwaysOnCluster", setter: "setAlwaysOnCluster")]
    #[SerializedName("alwaysOnCluster")]
    #[Type(AlwaysOnClusterSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AlwaysOnClusterSelector $cluster;

    /**
     * Constructor
     *
     * @param  AlwaysOnClusterSelector $cluster
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?AlwaysOnClusterSelector $cluster = null,
        ?string $attrs = null
    ) {
        $this->cluster = $cluster;
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get the cluster.
     *
     * @return AlwaysOnClusterSelector
     */
    public function getAlwaysOnCluster(): ?AlwaysOnClusterSelector
    {
        return $this->cluster;
    }

    /**
     * Set the cluster.
     *
     * @param  AlwaysOnClusterSelector $cluster
     * @return self
     */
    public function setAlwaysOnCluster(AlwaysOnClusterSelector $cluster): self
    {
        $this->cluster = $cluster;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAlwaysOnClusterEnvelope(
            new GetAlwaysOnClusterBody($this)
        );
    }
}
