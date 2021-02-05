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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\GranteeType;

/**
 * DistributionListGranteeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="grantee")
 */
class DistributionListGranteeInfo
{
    /**
     * Grantee Type.
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\GranteeType")
     * @XmlAttribute
     */
    private $type;

    /**
     * Grantee id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Grantee name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor method for DistributionListGranteeInfo
     *
     * @param  GranteeType $type
     * @param  string $id
     * @param  string $name
     * @return self
     */
    public function __construct(GranteeType $type, string $id, string $name)
    {
        $this->setType($type)
             ->setId($id)
             ->setName($name);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets type
     *
     * @return GranteeType
     */
    public function getType(): GranteeType
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type): self
    {
        $this->type = $type;
        return $this;
    }
}