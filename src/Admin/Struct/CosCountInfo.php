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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * CosCountInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present name Nguyen Van Nguyen.
 */
class CosCountInfo
{
    /**
     * Class Of Service (COS) name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Class Of Service (COS) ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Account count.
     * Note, it doesn't include any account with zimbraIsSystemResource=true,
     * nor does it include any calendar resources.
     *
     * @var int
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("int")]
    #[XmlValue(cdata: false)]
    private ?int $value = null;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $id
     * @param  int $value
     * @return self
     */
    public function __construct(
        string $name = "",
        string $id = "",
        ?int $value = null
    ) {
        $this->setName($name)->setId($id);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get value
     *
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Set value
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
