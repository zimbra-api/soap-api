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
use Zimbra\Common\Enum\DomainBy;

/**
 * DomainSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DomainSelector
{
    /**
     * Select the meaning of {acct-selector-key}
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\DomainBy")
     * @XmlAttribute
     */
    private DomainBy $by;

    /**
     * The key used to identify the domain
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for DomainSelector
     * 
     * @param  DomainBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?DomainBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? DomainBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets by enum
     *
     * @return DomainBy
     */
    public function getBy(): DomainBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
     *
     * @param  DomainBy $by
     * @return self
     */
    public function setBy(DomainBy $by): self
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
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
