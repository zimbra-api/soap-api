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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * ModifyTagNotification struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class ModifyTagNotification extends ModifyNotification
{
    /**
     * ID of modified tag
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlElement(cdata=false)
     */
    private $id;

    /**
     * Name of modified tag
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $name;

    /**
     * Constructor method for ModifyTagNotification
     * @param  int $id
     * @param  string $name
     * @param  int $changeBitmask
     * @return self
     */
    public function __construct(int $id, string $name, int $changeBitmask)
    {
        parent::__construct($changeBitmask);
        $this->setId($id)
             ->setName($name);
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
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
}
