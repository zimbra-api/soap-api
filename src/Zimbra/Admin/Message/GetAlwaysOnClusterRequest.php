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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetAlwaysOnClusterRequest class
 * Get Server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAlwaysOnClusterRequest")
 */
class GetAlwaysOnClusterRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Server
     * @Accessor(getter="getAlwaysOnCluster", setter="setAlwaysOnCluster")
     * @SerializedName("alwaysOnCluster")
     * @Type("Zimbra\Admin\Struct\AlwaysOnClusterSelector")
     * @XmlElement
     */
    private $cluster;

    /**
     * Constructor method for GetAlwaysOnClusterRequest
     * 
     * @param  AlwaysOnClusterSelector $cluster
     * @param  string $attrs
     * @return self
     */
    public function __construct(AlwaysOnClusterSelector $cluster = NULL, string $attrs = NULL)
    {
        if ($cluster instanceof AlwaysOnClusterSelector) {
            $this->setAlwaysOnCluster($cluster);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets the cluster.
     *
     * @return AlwaysOnClusterSelector
     */
    public function getAlwaysOnCluster(): ?AlwaysOnClusterSelector
    {
        return $this->cluster;
    }

    /**
     * Sets the cluster.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAlwaysOnClusterEnvelope)) {
            $this->envelope = new GetAlwaysOnClusterEnvelope(
                new GetAlwaysOnClusterBody($this)
            );
        }
    }
}
