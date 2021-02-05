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
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Soap\Request;

/**
 * GetSystemRetentionPolicyRequest class
 * Get System Retention Policy
 * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users
 * can apply to folders and tags.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetSystemRetentionPolicyRequest")
 */
class GetSystemRetentionPolicyRequest extends Request
{
    /**
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private $cos;

    /**
     * Constructor method for GetSystemRetentionPolicyRequest
     * 
     * @param  CosSelector $cos
     * @return self
     */
    public function __construct(?CosSelector $cos = NULL)
    {
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
    }

    /**
     * Gets cos
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Sets cos
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetSystemRetentionPolicyEnvelope)) {
            $this->envelope = new GetSystemRetentionPolicyEnvelope(
                new GetSystemRetentionPolicyBody($this)
            );
        }
    }
}