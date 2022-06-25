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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * HABMember struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
abstract class HABMember
{
    /**
     * HAB Member name - an email address (user@domain)
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $name;

    /**
     * seniorityIndex of the HAB group member
     * @Accessor(getter="getSeniorityIndex", setter="setSeniorityIndex")
     * @SerializedName("seniorityIndex")
     * @Type("integer")
     * @XmlAttribute
     */
    private $seniorityIndex;

    /**
     * Constructor method for HABMember
     * 
     * @param  string $name
     * @param  int $seniorityIndex
     * @return self
     */
    public function __construct(string $name, ?int $seniorityIndex = NULL)
    {
        $this->setName($name);
        if (NULL !== $seniorityIndex) {
            $this->setSeniorityIndex($seniorityIndex);
        }
    }

    /**
     * Gets name
     *
     * @return string
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
     * Gets seniorityIndex
     *
     * @return int
     */
    public function getSeniorityIndex(): ?int
    {
        return $this->seniorityIndex;
    }

    /**
     * Sets seniorityIndex
     *
     * @param  int $seniorityIndex
     * @return self
     */
    public function setSeniorityIndex(int $seniorityIndex): self
    {
        $this->seniorityIndex = $seniorityIndex;
        return $this;
    }
}
