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
use Zimbra\Enum\{GranteeType, GranteeBy};

/**
 * GranteeSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="grantee")
 */
class GranteeSelector
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\GranteeType")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\GranteeBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Password for guest grantee or the access key for key grantee
     * @Accessor(getter="getSecret", setter="setSecret")
     * @SerializedName("secret")
     * @Type("string")
     * @XmlAttribute
     */
    private $secret;

    /**
     * For GetGrantsRequest, selects whether to include grants granted to groups
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $all;

    /**
     * Constructor method for GranteeSelector
     * @param string $value The key used to secretentify the grantee
     * @param GranteeType $type Grantee type
     * @param GranteeBy $by Grantee by
     * @param string $secret Password for guest grantee or the access key for key grantee For user right only
     * @param bool   $all For GetGrantsRequest, selects whether to include grants granted to groups the specified grantee belongs to. Default is 1 (true)
     * @return self
     */
    public function __construct(
        $value = NULL,
        GranteeType $type = NULL,
        GranteeBy $by = NULL,
        $secret = NULL,
        $all = NULL
    )
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $by) {
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
     * Gets type enum
     *
     * @return GranteeType
     */
    public function getType(): GranteeType
    {
        return $this->type;
    }

    /**
     * Sets type enum
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
     * Gets by enum
     *
     * @return GranteeBy
     */
    public function getBy(): GranteeBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
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
     * Gets password for guest grantee or the access key for key grantee
     *
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * Sets password for guest grantee or the access key for key grantee
     *
     * @param  string $secret
     * @return self
     */
    public function setSecret($secret): self
    {
        $this->secret = trim($secret);
        return $this;
    }

    /**
     * Gets all flag
     *
     * @return bool
     */
    public function getAll(): bool
    {
        return $this->all;
    }

    /**
     * Sets all flag
     *
     * @param  bool $all
     * @return self
     */
    public function setAll($all): self
    {
        $this->all = (bool) $all;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = trim($value);
        return $this;
    }
}
