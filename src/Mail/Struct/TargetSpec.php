<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\{AccountBy, TargetType};

/**
 * TargetSpec class
 * Target specification
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TargetSpec
{
    /**
     * Target type
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\TargetType")
     * @XmlAttribute
     */
    private TargetType $targetType;

    /**
     * Select the meaning of {value}
     * @Accessor(getter="getAccountBy", setter="setAccountBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\AccountBy")
     * @XmlAttribute
     */
    private AccountBy $accountBy;

    /**
     * The key used to identify the target
     * Meaning determined by {accountBy}
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for TargetSpec
     *
     * @param  TargetType $targetType
     * @param  AccountBy $accountBy
     * @param  string $value
     * @return self
     */
    public function __construct(
        TargetType $targetType, AccountBy $accountBy, ?string $value = NULL
    )
    {
        $this->setTargetType($targetType)
             ->setAccountBy($accountBy);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets targetType
     *
     * @return TargetType
     */
    public function getTargetType(): TargetType
    {
        return $this->targetType;
    }

    /**
     * Sets targetType
     *
     * @param  TargetType $targetType
     * @return self
     */
    public function setTargetType(TargetType $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }

    /**
     * Gets accountBy
     *
     * @return AccountBy
     */
    public function getAccountBy(): AccountBy
    {
        return $this->accountBy;
    }

    /**
     * Sets accountBy
     *
     * @param  AccountBy $accountBy
     * @return self
     */
    public function setAccountBy(AccountBy $accountBy): self
    {
        $this->accountBy = $accountBy;
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
