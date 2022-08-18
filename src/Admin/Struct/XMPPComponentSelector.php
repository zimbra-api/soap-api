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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\XmppComponentBy;

/**
 * XMPPComponentSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class XMPPComponentSelector
{
    /**
     * Select the meaning of {xmpp-comp-selector-key}
     * 
     * @var XmppComponentBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName(name: 'by')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\XmppComponentBy>')]
    #[XmlAttribute]
    private $by;

    /**
     * The key used to identify the XMPP component
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  XmppComponentBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?XmppComponentBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? XmppComponentBy::ID);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return XmppComponentBy
     */
    public function getBy(): XmppComponentBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  XmppComponentBy $by
     * @return self
     */
    public function setBy(XmppComponentBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
