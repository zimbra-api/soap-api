<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\Prop;
use Zimbra\Soap\Request;

/**
 * ModifyPropertiesRequest class
 * Modify properties related to zimlets
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyPropertiesRequest extends Request
{
    /**
     * Property to be modified
     * @Accessor(getter="getProps", setter="setProps")
     * @SerializedName("prop")
     * @Type("array<Zimbra\Account\Struct\Prop>")
     * @XmlList(inline = true, entry = "prop")
     */
    private $props = [];

    /**
     * Constructor method for ModifyPropertiesRequest
     *
     * @param  array $props
     * @return self
     */
    public function __construct(array $props = [])
    {
        $this->setProps($props);
    }

    /**
     * Add a prop
     *
     * @param  Prop $prop
     * @return self
     */
    public function addProp(Prop $prop): self
    {
        $this->props[] = $prop;
        return $this;
    }

    /**
     * Set props
     *
     * @param  array $props
     * @return self
     */
    public function setProps(array $props): self
    {
        $this->props = [];
        foreach ($props as $prop) {
            if ($prop instanceof Prop) {
                $this->props[] = $prop;
            }
        }
        return $this;
    }

    /**
     * Gets props
     *
     * @return array
     */
    public function getProps(): array
    {
        return $this->props;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyPropertiesEnvelope)) {
            $this->envelope = new ModifyPropertiesEnvelope(
                new ModifyPropertiesBody($this)
            );
        }
    }
}
