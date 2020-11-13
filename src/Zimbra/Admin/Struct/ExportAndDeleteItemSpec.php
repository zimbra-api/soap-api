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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * ExportAndDeleteItemSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="item")
 */
class ExportAndDeleteItemSpec
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version;

    /**
     * Constructor method for ExportAndDeleteItemSpec
     * @param  int $id ID
     * @param  int $version Version
     * @return self
     */
    public function __construct($id, $version)
    {
        $this->setId($id)
             ->setVersion($version);
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Sets version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion($version): self
    {
        $this->version = (int) $version;
        return $this;
    }
}
