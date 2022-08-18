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

use JMS\Serializer\Annotation\{
    Accessor, Exclude, SerializedName, SkipWhenEmpty, Type, VirtualProperty, XmlAttribute
};
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
     * The name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * The id
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
     * Last known sync token
     * 
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getToken', setter: 'setToken')]
    #[SerializedName('token')]
    #[Type('string')]
    #[XmlAttribute]
    private $token;

    /**
     * Comma-separated list
     * 
     * @Accessor(getter="getInterests", setter="setInterests")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getInterests', setter: 'setInterests')]
    #[SerializedName('types')]
    #[Type('string')]
    #[XmlAttribute]
    private $interests;

    /**
     * @Exclude
     * 
     * @var array
     */
    #[Exclude]
    private $folderInterests = [];

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $id
     * @param string $token
     * @param string $interests
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
     * Get the name
     *
     * @return string
     */
    public function getName(): ?string
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
     * Get Id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set Id
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
     * Get the token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set the token
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
     * Set interests
     *
     * @param string $interests
     * @return self
     */
    public function setInterests(string $interests): self
    {
        $types = array_filter(explode(',', $interests), static fn ($type) => InterestType::isValid($type));
        $this->interests = !empty($types) ? implode(',', array_unique($types)) : NULL;
        return $this;
    }

    /**
     * Get interests
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
     * @SerializedName("folderInterests")
     * @SkipWhenEmpty
     * @Type("string")
     * @VirtualProperty
     * @XmlAttribute
     *
     * @return string
     */
    #[SerializedName('folderInterests')]
    #[SkipWhenEmpty]
    #[Type('string')]
    #[VirtualProperty]
    #[XmlAttribute]
    public function getFolderInterests(): ?string
    {
        return !empty($this->folderInterests) ? implode(',', $this->folderInterests) : NULL;
    }
}
