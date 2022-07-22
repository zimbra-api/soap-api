<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\RestoreResolve;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * RestoreContactsRequest class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RestoreContactsRequest extends Request
{
    /**
     * Filename of contact backup file
     * 
     * @Accessor(getter="getContactsBackupFileName", setter="setContactsBackupFileName")
     * @SerializedName("contactsBackupFileName")
     * @Type("string")
     * @XmlAttribute
     */
    private $contactsBackupFileName;

    /**
     * Restore resolve action - one of ignore|modify|replace|reset
     * Default value - reset
     * ignore - In case of conflict, ignore the existing contact. Create new contact from backup file.
     * modify - In case of conflict, merge the existing contact with contact in backup file.
     * replace - In case of conflict, replace the existing contact with contact in backup file.
     * reset - Delete all existing contacts and restore contacts from backup file.
     * 
     * @Accessor(getter="getResolve", setter="setResolve")
     * @SerializedName("resolve")
     * @Type("Zimbra\Common\Enum\RestoreResolve")
     * @XmlAttribute
     */
    private ?RestoreResolve $resolve = NULL;

    /**
     * Constructor method for RestoreContactsRequest
     *
     * @param  string $fileName
     * @param  RestoreResolve $resolve
     * @return self
     */
    public function __construct(
        string $fileName = '',
        ?RestoreResolve $resolve = NULL
    )
    {
        $this->setContactsBackupFileName($fileName);
        if ($resolve instanceof RestoreResolve) {
            $this->setResolve($resolve);
        }
    }

    /**
     * Gets contactsBackupFileName
     *
     * @return string
     */
    public function getContactsBackupFileName(): string
    {
        return $this->contactsBackupFileName;
    }

    /**
     * Sets contactsBackupFileName
     *
     * @param  string $contactsBackupFileName
     * @return self
     */
    public function setContactsBackupFileName(string $fileName): self
    {
        $this->contactsBackupFileName = $fileName;
        return $this;
    }

    /**
     * Gets resolve
     *
     * @return RestoreResolve
     */
    public function getResolve(): ?RestoreResolve
    {
        return $this->resolve;
    }

    /**
     * Sets resolve
     *
     * @param  RestoreResolve $resolve
     * @return self
     */
    public function setResolve(RestoreResolve $resolve): self
    {
        $this->resolve = $resolve;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RestoreContactsEnvelope(
            new RestoreContactsBody($this)
        );
    }
}
