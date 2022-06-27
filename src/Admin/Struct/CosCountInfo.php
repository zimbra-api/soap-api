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

/**
 * CosCountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present name Nguyen Van Nguyen.
 */
class CosCountInfo
{
    /**
     * Class Of Service (COS) name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Class Of Service (COS) ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Account count.
     * Note, it doesn't include any account with zimbraIsSystemResource=TRUE, 
     * nor does it include any calendar resources.
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("int")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for CosCountInfo
     * @param  string $name
     * @param  string $id
     * @param  int $value
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', ?int $value = NULL
    )
    {
        $this->setName($name)
             ->setId($id);
        if (NULL !== $value) {
            $this->setValue($value);
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
     * Gets value
     *
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  int $value
     * @return self
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }
}
