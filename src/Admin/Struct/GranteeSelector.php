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
use Zimbra\Common\Enum\{GranteeType, GranteeBy};

/**
 * GranteeSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GranteeSelector
{
    /**
     * Grantee type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\GranteeType")
     * @XmlAttribute
     */
    private ?GranteeType $type = NULL;

    /**
     * Grantee by
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\GranteeBy")
     * @XmlAttribute
     */
    private ?GranteeBy $by = NULL;

    /**
     * The key used to secretentify the grantee
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Password for guest grantee or the access key for key grantee For user right only
     * @Accessor(getter="getSecret", setter="setSecret")
     * @SerializedName("secret")
     * @Type("string")
     * @XmlAttribute
     */
    private $secret;

    /**
     * For GetGrantsRequest, selects whether to include grants granted to groups the specified grantee belongs to. Default is 1 (true)
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $all;

    /**
     * Constructor method for GranteeSelector
     * @param string $value
     * @param GranteeType $type
     * @param GranteeBy $by
     * @param string $secret
     * @param bool   $all
     * @return self
     */
    public function __construct(
        ?string $value = NULL,
        ?GranteeType $type = NULL,
        ?GranteeBy $by = NULL,
        ?string $secret = NULL,
        ?bool $all = NULL
    )
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if ($type instanceof GranteeType) {
            $this->setType($type);
        }
        if ($by instanceof GranteeBy) {
            $this->setBy($by);
        }
        if (NULL !== $secret) {
            $this->setSecret($secret);
        }
        if (NULL !== $all) {
            $this->setAll($all);
        }
    }

    /**
     * Get type enum
     *
     * @return GranteeType
     */
    public function getType(): ?GranteeType
    {
        return $this->type;
    }

    /**
     * Set type enum
     *
     * @param  GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get by enum
     *
     * @return GranteeBy
     */
    public function getBy(): ?GranteeBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  GranteeBy $by
     * @return self
     */
    public function setBy(GranteeBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * Set secret
     *
     * @param  string $secret
     * @return self
     */
    public function setSecret(string $secret): self
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Get all flag
     *
     * @return bool
     */
    public function getAll(): ?bool
    {
        return $this->all;
    }

    /**
     * Set all flag
     *
     * @param  bool $all
     * @return self
     */
    public function setAll(bool $all): self
    {
        $this->all = $all;
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
