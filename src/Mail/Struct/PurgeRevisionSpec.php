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
 * PurgeRevisionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PurgeRevisionSpec
{
    /**
     * Item ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Revision
     *
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getVersion", setter: "setVersion")]
    #[SerializedName("ver")]
    #[Type("int")]
    #[XmlAttribute]
    private $version;

    /**
     * When set, the server will purge all the old revisions inclusive of the revision
     * specified in the request.
     *
     * @Accessor(getter="getIncludeOlderRevisions", setter="setIncludeOlderRevisions")
     * @SerializedName("includeOlderRevisions")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getIncludeOlderRevisions",
            setter: "setIncludeOlderRevisions"
        )
    ]
    #[SerializedName("includeOlderRevisions")]
    #[Type("bool")]
    #[XmlAttribute]
    private $includeOlderRevisions;

    /**
     * Constructor
     *
     * @param string $id
     * @param int $version
     * @param bool $includeOlderRevisions
     * @return self
     */
    public function __construct(
        string $id = "",
        int $version = 0,
        ?bool $includeOlderRevisions = null
    ) {
        $this->setId($id)->setVersion($version);
        if (null !== $includeOlderRevisions) {
            $this->setIncludeOlderRevisions($includeOlderRevisions);
        }
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
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
     * Get includeOlderRevisions
     *
     * @return bool
     */
    public function getIncludeOlderRevisions(): ?bool
    {
        return $this->includeOlderRevisions;
    }

    /**
     * Set includeOlderRevisions
     *
     * @param  bool $includeOlderRevisions
     * @return self
     */
    public function setIncludeOlderRevisions(bool $includeOlderRevisions): self
    {
        $this->includeOlderRevisions = $includeOlderRevisions;
        return $this;
    }
}
