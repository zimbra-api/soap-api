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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * Session struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Session
{
    /**
     * Session type - currently only set if value is "admin"
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[Type('string')]
    #[XmlAttribute]
    private $type;

    /**
     * Session ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Constructor
     * 
     * @param  string $id
     * @param  string $type
     * @return self
     */
    public function __construct(string $id = '', ?string $type = NULL)
    {
        $this->setId($id);
        if (NULL !== $type) {
            $this->setType($type);
        }
    }

    /**
     * Get session type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set session type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get session id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set session id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
