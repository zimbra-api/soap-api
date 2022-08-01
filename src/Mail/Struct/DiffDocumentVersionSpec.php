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
 * DiffDocumentVersionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiffDocumentVersionSpec
{
    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Revision 1
     * 
     * @Accessor(getter="getVersion1", setter="setVersion1")
     * @SerializedName("v1")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version1;

    /**
     * Revision 2
     * 
     * @Accessor(getter="getVersion2", setter="setVersion2")
     * @SerializedName("v2")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version2;

    /**
     * Constructor method
     * 
     * @param string $id
     * @param int $version1
     * @param int $version2
     * @return self
     */
    public function __construct(
        string $id = '', ?int $version1 = NULL, ?int $version2 = NULL
    )
    {
        $this->setId($id);
        if (NULL !== $version1) {
            $this->setVersion1($version1);
        }
        if (NULL !== $version2) {
            $this->setVersion2($version2);
        }
    }

    /**
     * Get version 1
     *
     * @return int
     */
    public function getVersion1(): ?int
    {
        return $this->version1;
    }

    /**
     * Set version 1
     *
     * @param  int $version1
     * @return self
     */
    public function setVersion1(int $version1): self
    {
        $this->version1 = $version1;
        return $this;
    }

    /**
     * Get version 2
     *
     * @return int
     */
    public function getVersion2(): ?int
    {
        return $this->version2;
    }

    /**
     * Set version 2
     *
     * @param  int $version2
     * @return self
     */
    public function setVersion2(int $version2): self
    {
        $this->version2 = $version2;
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
}
