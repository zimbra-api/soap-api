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

use Zimbra\Enum\ContactBackupStatus;

/**
 * ContactBackupServer struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="server")
 */
class ContactBackupServer
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\ContactBackupStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for ContactBackupServer
     * @param string $name
     * @param ContactBackupStatus $status
     * @return self
     */
    public function __construct(string $name, ContactBackupStatus $status)
    {
        $this->setName($name)
             ->setStatus($status);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets status
     *
     * @return string
     */
    public function getStatus(): ContactBackupStatus
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  ContactBackupStatus $status
     * @return self
     */
    public function setStatus(ContactBackupStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}