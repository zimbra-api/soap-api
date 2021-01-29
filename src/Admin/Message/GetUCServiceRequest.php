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
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetUCServiceRequest class
 * Get UC Service
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetUCServiceRequest")
 */
class GetUCServiceRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * UC Service
     * @Accessor(getter="getUCService", setter="setUCService")
     * @SerializedName("ucservice")
     * @Type("Zimbra\Admin\Struct\UcServiceSelector")
     * @XmlElement
     */
    private $ucService;

    /**
     * Constructor method for GetUCServiceRequest
     * 
     * @param  UcServiceSelector $ucService
     * @param  string $attrs
     * @return self
     */
    public function __construct(UcServiceSelector $ucService, ?string $attrs = NULL)
    {
        $this->setUCService($ucService);
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets the ucService.
     *
     * @return UcServiceSelector
     */
    public function getUCService(): UcServiceSelector
    {
        return $this->ucService;
    }

    /**
     * Sets the ucService.
     *
     * @param  UcServiceSelector $ucService
     * @return self
     */
    public function setUCService(UcServiceSelector $ucService): self
    {
        $this->ucService = $ucService;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetUCServiceEnvelope)) {
            $this->envelope = new GetUCServiceEnvelope(
                new GetUCServiceBody($this)
            );
        }
    }
}
