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
 * ListDocumentRevisionsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ListDocumentRevisionsSpec
{
    /**
     * Item ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Version
     * 
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("int")
     * @XmlAttribute
     */
    private $version;

    /**
     * Maximum number of revisions to return starting from <version>
     * 
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("count")
     * @Type("int")
     * @XmlAttribute
     */
    private $count;

    /**
     * Constructor
     * 
     * @param string $id
     * @param int $version
     * @param int $count
     * @return self
     */
    public function __construct(
        string $id = '', ?int $version = NULL, ?int $count = NULL
    )
    {
        $this->setId($id);
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $count) {
            $this->setCount($count);
        }
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion(): ?int
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
     * Get count
     *
     * @return int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * Set the count
     *
     * @param  int $count
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }
}
