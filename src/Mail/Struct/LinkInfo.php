<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * LinkInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class LinkInfo
{
    /**
     * Shared item ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * 
     * @Accessor(getter="getUuid", setter="setUuid")
     * @SerializedName("uuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uuid;

    /**
     * Item name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Item type
     * 
     * @Accessor(getter="getDefaultView", setter="setDefaultView")
     * @SerializedName("view")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultView;

    /**
     * Permissions granted
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("perm")
     * @Type("string")
     * @XmlAttribute
     */
    private $rights;

    /**
     * Constructor method
     * 
     * @param string $id
     * @param string $uuid
     * @param string $name
     * @param string $defaultView
     * @param string $rights
     * @return self
     */
    public function __construct(
        string $id = '',
        string $uuid = '',
        string $name = '',
        string $defaultView = '',
        ?string $rights = NULL,
    )
    {
        $this->setId($id)
             ->setUuid($uuid)
             ->setName($name)
             ->setDefaultView($defaultView);
        if (NULL !== $rights) {
            $this->setRights($rights);
        }
    }

    /**
     * Gets uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Sets uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
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
     * Gets the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
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
     * Gets defaultView
     *
     * @return string
     */
    public function getDefaultView(): string
    {
        return $this->defaultView;
    }

    /**
     * Sets defaultView
     *
     * @param  string $defaultView
     * @return self
     */
    public function setDefaultView(string $defaultView): self
    {
        $this->defaultView = $defaultView;
        return $this;
    }

    /**
     * Gets rights
     *
     * @return string
     */
    public function getRights(): ?string
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $this->rights = $rights;
        return $this;
    }
}
