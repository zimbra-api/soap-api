<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\AccountBy;

/**
 * AccountSelector class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountSelector
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Enum<Zimbra\Common\Enum\AccountBy>")
     * @XmlAttribute
     */
    private AccountBy $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor
     * 
     * @param  AccountBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?AccountBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? new AccountBy('name'));
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get account by
     *
     * @return AccountBy
     */
    public function getBy(): AccountBy
    {
        return $this->by;
    }

    /**
     * Set account by enum
     *
     * @param  AccountBy $by
     * @return self
     */
    public function setBy(AccountBy $by): self
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
