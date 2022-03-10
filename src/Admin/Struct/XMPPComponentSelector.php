<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * XMPPComponentSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class XMPPComponentSelector
{
    /**
     * Select the meaning of {xmpp-comp-selector-key}
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\XmppComponentBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * The key used to identify the XMPP component
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for XmppComponentSelector
     * @param  XmppBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(XmppBy $by, ?string $value = NULL)
    {
        $this->setBy($by);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets by enum
     *
     * @return XmppBy
     */
    public function getBy(): XmppBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
     *
     * @param  XmppBy $by
     * @return self
     */
    public function setBy(XmppBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
