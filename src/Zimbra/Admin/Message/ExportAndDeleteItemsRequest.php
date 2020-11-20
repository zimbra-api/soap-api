<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec as Mailbox;
use Zimbra\Soap\Request;

/**
 * ExportAndDeleteItemsRequest class
 * Exports the database data for the given items with SELECT INTO OUTFILE and deletes the items from the mailbox.
 * Exported filenames follow the pattern {prefix}{table_name}.txt.  The files are written to sqlExportDir.
 * When sqlExportDir is not specified, data is not exported. Export is only supported for MySQL.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ExportAndDeleteItemsRequest")
 */
class ExportAndDeleteItemsRequest extends Request
{
    /**
     * Path for export dir
     * @Accessor(getter="getExportDir", setter="setExportDir")
     * @SerializedName("exportDir")
     * @Type("string")
     * @XmlAttribute
     */
    private $exportDir;

    /**
     * Export filename prefix
     * @Accessor(getter="getExportFilenamePrefix", setter="setExportFilenamePrefix")
     * @SerializedName("exportFilenamePrefix")
     * @Type("string")
     * @XmlAttribute
     */
    private $exportFilenamePrefix;

    /**
     * Export filename prefix
     * @Accessor(getter="getMailbox", setter="setMailbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec")
     * @XmlElement
     */
    private $mailbox;

    /**
     * Constructor method for ExportAndDeleteItemsRequest
     * @param  Mailbox $mailbox
     * @param  string $exportDir
     * @param  string $exportFilenamePrefix
     * @return self
     */
    public function __construct(Mailbox $mailbox, $exportDir = NULL, $exportFilenamePrefix = NULL)
    {
        $this->setMailbox($mailbox);
        if (NULL !== $exportDir) {
            $this->setExportDir($exportDir);
        }
        if (NULL !== $exportFilenamePrefix) {
            $this->setExportFilenamePrefix($exportFilenamePrefix);
        }
    }

    /**
     * Gets the mailbox.
     *
     * @return Mailbox
     */
    public function getMailbox(): Mailbox
    {
        return $this->mailbox;
    }

    /**
     * Sets the mailbox.
     *
     * @param  Mailbox $mailbox
     * @return self
     */
    public function setMailbox(Mailbox $mailbox): self
    {
        $this->mailbox = $mailbox;
        return $this;
    }

    /**
     * Gets exportDir
     *
     * @return string
     */
    public function getExportDir(): ?string
    {
        return $this->exportDir;
    }

    /**
     * Sets exportDir
     *
     * @param  string $exportDir
     * @return self
     */
    public function setExportDir($exportDir): self
    {
        $this->exportDir = trim($exportDir);
        return $this;
    }

    /**
     * Gets exportFilenamePrefix
     *
     * @return string
     */
    public function getExportFilenamePrefix(): ?string
    {
        return $this->exportFilenamePrefix;
    }

    /**
     * Sets exportFilenamePrefix
     *
     * @param  string $exportFilenamePrefix
     * @return self
     */
    public function setExportFilenamePrefix($exportFilenamePrefix): self
    {
        $this->exportFilenamePrefix = trim($exportFilenamePrefix);
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ExportAndDeleteItemsEnvelope)) {
            $this->envelope = new ExportAndDeleteItemsEnvelope(
                new ExportAndDeleteItemsBody($this)
            );
        }
    }
}
