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
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Request;

/**
 * GetConfigRequest class
 * Get Config request
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetConfigRequest extends Request
{
    /**
     * Attribute
     * @Accessor(getter="getAttr", setter="setAttr")
     * @SerializedName("a")
     * @Type("Zimbra\Admin\Struct\Attr")
     * @XmlElement
     */
    private ?Attr $attr = NULL;

    /**
     * Constructor method for GetConfigRequest
     * 
     * @param  Attr $attr
     * @return self
     */
    public function __construct(?Attr $attr = NULL)
    {
        if ($attr instanceof Attr) {
            $this->setAttr($attr);
        }
    }

    /**
     * Gets the attr.
     *
     * @return Attr
     */
    public function getAttr(): ?Attr
    {
        return $this->attr;
    }

    /**
     * Sets the attr.
     *
     * @param  Attr $attr
     * @return self
     */
    public function setAttr(Attr $attr): self
    {
        $this->attr = $attr;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetConfigEnvelope)) {
            $this->envelope = new GetConfigEnvelope(
                new GetConfigBody($this)
            );
        }
    }
}
