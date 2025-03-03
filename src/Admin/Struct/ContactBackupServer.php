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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ContactBackupStatus;

/**
 * ContactBackupServer struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactBackupServer
{
    /**
     * Name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Backup status
     *
     * @var ContactBackupStatus
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[XmlAttribute]
    private ContactBackupStatus $status;

    /**
     * Constructor
     *
     * @param string $name
     * @param ContactBackupStatus $status
     * @return self
     */
    public function __construct(
        string $name = "",
        ?ContactBackupStatus $status = null
    ) {
        $this->setName($name)->setStatus(
            $status ?? ContactBackupStatus::STOPPED
        );
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get status
     *
     * @return ContactBackupStatus
     */
    public function getStatus(): ContactBackupStatus
    {
        return $this->status;
    }

    /**
     * Set status
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
