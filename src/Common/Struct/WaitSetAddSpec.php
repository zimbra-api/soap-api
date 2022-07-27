<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, SkipWhenEmpty, Type, VirtualProperty, XmlAttribute};
use Zimbra\Common\Enum\InterestType;

/**
 * WaitSetAddSpec class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WaitSetAddSpec
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * @Accessor(getter="getInterests", setter="setInterests")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $interests;

    /**
     * @Exclude
     */
    private $folderInterests = [];

    /**
     * Constructor method for waitSetAddSpec
     * @param string $name The name
     * @param string $id The id
     * @param string $token Last known sync token
     * @param string $interests Comma-separated list
     * @return self
     */
    public function __construct(
        ?string $name = NULL,
        ?string $id = NULL,
        ?string $token = NULL,
        ?string $interests = NULL
    )
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $token) {
            $this->setToken($token);
        }
        if (NULL !== $interests) {
            $this->setInterests($interests);
        }
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName(): ?string
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
     * Gets Id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets Id
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
     * Gets the token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets the token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Sets interests
     *
     * @param string $interests Comma-separated list
     * @return self
     */
    public function setInterests($interests): self
    {
        $types = [];
        if (is_array($interests)) {
            $types = array_filter($interests, static fn ($type) => InterestType::isValid($type));
        }
        elseif (!empty($interests)) {
            $types = array_filter(explode(',', $interests), static fn ($type) => InterestType::isValid($type));
        }
        $this->interests = !empty($types) ? implode(',', array_unique($types)) : NULL;
        return $this;
    }

    /**
     * Gets interests
     *
     * @return string
     */
    public function getInterests(): ?string
    {
        return $this->interests;
    }

    public function addFolderInterest($folderId): self
    {
        $folderId = (int) $folderId;
        if (!in_array($folderId, $this->folderInterests)) {
            $this->folderInterests[] = $folderId;
        }
        return $this;
    }

    public function setFolderInterests($folderInterests): self
    {
        $this->folderInterests = [];
        if (is_array($folderInterests)) {
            $folderInterests = array_map(static fn ($folderId) => (int) $folderId, $folderInterests);
            $this->folderInterests = array_unique($folderInterests);
        }
        else {
            $folderInterests = array_map(static fn ($folderId) => (int) $folderId, explode(',', $folderInterests));
            $this->folderInterests = array_unique($folderInterests);
        }
        return $this;
    }

    /**
     * @VirtualProperty
     * @Type("string")
     * @SerializedName("folderInterests")
     * @SkipWhenEmpty
     * @XmlAttribute
     *
     * @return string
     */
    public function getFolderInterests(): ?string
    {
        return !empty($this->folderInterests) ? implode(',', $this->folderInterests) : NULL;
    }
}
