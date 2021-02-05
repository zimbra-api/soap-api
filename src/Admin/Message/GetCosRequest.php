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
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetCosRequest class
 * Get Class Of Service (COS)
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetCosRequest")
 */
class GetCosRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * COS
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private $cos;

    /**
     * Constructor method for GetCosRequest
     * 
     * @param  CosSelector $cos
     * @param  string $attrs
     * @return self
     */
    public function __construct(CosSelector $cos, ?string $attrs = NULL)
    {
        $this->setCos($cos);
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets the cos.
     *
     * @return CosSelector
     */
    public function getCos(): CosSelector
    {
        return $this->cos;
    }

    /**
     * Sets the cos.
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
        if (!($this->envelope instanceof GetCosEnvelope)) {
            $this->envelope = new GetCosEnvelope(
                new GetCosBody($this)
            );
        }
    }
}