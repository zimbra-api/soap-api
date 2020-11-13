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
 * IdStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="device")
 */
class IdStatus
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("string")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for IdStatus
     * @param  string $id
     * @param  string $status
     * @return self
     */
    public function __construct($id = NULL, $status = NULL)
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $status) {
            $this->setStatus($status);
        }
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  string $status
     * @return self
     */
    public function setStatus($status): self
    {
        $this->status = trim($status);
        return $this;
    }
}
