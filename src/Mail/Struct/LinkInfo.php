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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LinkInfo
{
    /**
     * Shared item ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Item's UUID - a globally unique identifier
     *
     * @var string
     */
    #[Accessor(getter: "getUuid", setter: "setUuid")]
    #[SerializedName("uuid")]
    #[Type("string")]
    #[XmlAttribute]
    private string $uuid;

    /**
     * Item name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Item type
     *
     * @var string
     */
    #[Accessor(getter: "getDefaultView", setter: "setDefaultView")]
    #[SerializedName("view")]
    #[Type("string")]
    #[XmlAttribute]
    private string $defaultView;

    /**
     * Permissions granted
     *
     * @var string
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("perm")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $rights = null;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $uuid
     * @param string $name
     * @param string $defaultView
     * @param string $rights
     * @return self
     */
    public function __construct(
        string $id = "",
        string $uuid = "",
        string $name = "",
        string $defaultView = "",
        ?string $rights = null
    ) {
        $this->setId($id)
            ->setUuid($uuid)
            ->setName($name)
            ->setDefaultView($defaultView);
        if (null !== $rights) {
            $this->setRights($rights);
        }
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
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
     * Get defaultView
     *
     * @return string
     */
    public function getDefaultView(): string
    {
        return $this->defaultView;
    }

    /**
     * Set defaultView
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
     * Get rights
     *
     * @return string
     */
    public function getRights(): ?string
    {
        return $this->rights;
    }

    /**
     * Set rights
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
