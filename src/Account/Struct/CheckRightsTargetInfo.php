<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\{TargetBy, TargetType};

/**
 * CheckRightsTargetInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckRightsTargetInfo
{
    /**
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\TargetType>")
     * @XmlAttribute
     * @var TargetType
     */
    private $targetType;

    /**
     * @Accessor(getter="getTargetBy", setter="setTargetBy")
     * @SerializedName("by")
     * @Type("Enum<Zimbra\Common\Enum\TargetBy>")
     * @XmlAttribute
     * @var TargetBy
     */
    private $targetBy;

    /**
     * @Accessor(getter="getTargetKey", setter="setTargetKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $targetKey;

    /**
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allow;

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<Zimbra\Account\Struct\CheckRightsRightInfo>")
     * @XmlList(inline=true, entry="right", namespace="urn:zimbraAccount")
     */
    private $rights = [];

    /**
     * Constructor
     * 
     * @param  TargetType $type
     * @param  TargetBy $by
     * @param  string $key
     * @param  bool $allow
     * @param  array $rights
     * @return self
     */
    public function __construct(
        ?TargetType $type = NULL, ?TargetBy $by = NULL, string $key = '', bool $allow = FALSE, array $rights = []
    )
    {
        $this->setTargetType($type ?? new TargetType('account'))
             ->setTargetBy($by ?? new TargetBy('name'))
             ->setTargetKey($key)
             ->setAllow($allow)
             ->setRights($rights);
    }

    /**
     * Get target type
     *
     * @return TargetType
     */
    public function getTargetType(): TargetType
    {
        return $this->targetType;
    }

    /**
     * Set target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setTargetType(TargetType $type): self
    {
        $this->targetType = $type;
        return $this;
    }

    /**
     * Get target by
     *
     * @return TargetBy
     */
    public function getTargetBy(): TargetBy
    {
        return $this->targetBy;
    }

    /**
     * Set target by
     *
     * @param  TargetBy $by
     * @return self
     */
    public function setTargetBy(TargetBy $by): self
    {
        $this->targetBy = $by;
        return $this;
    }

    /**
     * Get target key
     *
     * @return string
     */
    public function getTargetKey(): string
    {
        return $this->targetKey;
    }

    /**
     * Set target key
     *
     * @param  string $key
     * @return self
     */
    public function setTargetKey(string $key): self
    {
        $this->targetKey = $key;
        return $this;
    }

    /**
     * Get target allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Set target allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter($rights, static fn ($right) => $right instanceof CheckRightsRightInfo);
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
