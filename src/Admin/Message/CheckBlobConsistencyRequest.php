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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * Checks for items that have no blob, blobs that have no item, and items that have an incorrect blob size stored in their metadata
 *.If no volumes are specified, all volumes are checked.
 * If no mailboxes are specified, all mailboxes are checked.
 * Blob sizes are checked by default.
 * Set checkSize to 0 (false) to * avoid the CPU overhead of uncompressing compressed blobs in order to calculate size.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckBlobConsistencyRequest extends Request
{
    /**
     * Set checkSize to 0 (false) to avoid the CPU overhead of uncompressing
     * compressed blobs in order to calculate size.
     * @Accessor(getter="getCheckSize", setter="setCheckSize")
     * @SerializedName("checkSize")
     * @Type("bool")
     * @XmlAttribute
     */
    private $checkSize;

    /**
     * If set a complete list of all blobs used by the mailbox(es) is returned
     * @Accessor(getter="getReportUsedBlobs", setter="setReportUsedBlobs")
     * @SerializedName("reportUsedBlobs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $reportUsedBlobs;

    /**
     * Volumes
     * 
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @SerializedName("volume")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="volume")
     */
    private $volumes = [];

    /**
     * Mailboxes
     * 
     * @Accessor(getter="getMailboxes", setter="setMailboxes")
     * @SerializedName("mbox")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="mbox")
     */
    private $mailboxes = [];

    /**
     * Constructor method for CheckBlobConsistencyRequest
     * 
     * @param  bool $checkSize
     * @param  bool $reportUsedBlobs
     * @param  array $volumes
     * @param  array $mailboxes
     * @return self
     */
    public function __construct(
        ?bool $checkSize = NULL, ?bool $reportUsedBlobs = NULL, array $volumes = [], array $mailboxes = []
    )
    {
        $this->setVolumes($volumes)
             ->setMailboxes($mailboxes);
        if (NULL !== $checkSize) {
            $this->setCheckSize($checkSize);
        }
        if (NULL !== $reportUsedBlobs){
            $this->setReportUsedBlobs($reportUsedBlobs);
        }
    }

    /**
     * Gets check size
     *
     * @return bool
     */
    public function getCheckSize(): ?bool
    {
        return $this->checkSize;
    }

    /**
     * Sets check size
     *
     * @param  bool $checkSize
     * @return self
     */
    public function setCheckSize(bool $checkSize): self
    {
        $this->checkSize = $checkSize;
        return $this;
    }

    /**
     * Gets report used blobs
     *
     * @return bool
     */
    public function getReportUsedBlobs(): ?bool
    {
        return $this->reportUsedBlobs;
    }

    /**
     * Sets report used blobs
     *
     * @param  bool $checkSize
     * @return self
     */
    public function setReportUsedBlobs(bool $reportUsedBlobs): self
    {
        $this->reportUsedBlobs = $reportUsedBlobs;
        return $this;
    }

    /**
     * Add a volume
     *
     * @param  IntIdAttr $volume
     * @return self
     */
    public function addVolume(IntIdAttr $volume): self
    {
        $this->volumes[] = $volume;
        return $this;
    }

    /**
     * Sets volume array
     *
     * @param  array $volumes
     * @return self
     */
    public function setVolumes(array $volumes): self
    {
        $this->volumes = array_filter($volumes, static fn ($volume) => $volume instanceof IntIdAttr);
        return $this;
    }

    /**
     * Gets volume array
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }

    /**
     * Add a mailbox
     *
     * @param  IntIdAttr $mailbox
     * @return self
     */
    public function addMailbox(IntIdAttr $mailbox): self
    {
        $this->mailboxes[] = $mailbox;
        return $this;
    }

    /**
     * Sets mailbox array
     *
     * @param  array $mailboxes
     * @return self
     */
    public function setMailboxes(array $mailboxes): self
    {
        $this->mailboxes = array_filter($mailboxes, static fn ($mailbox) => $mailbox instanceof IntIdAttr);
        return $this;
    }

    /**
     * Gets mailbox array
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        return $this->mailboxes;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CheckBlobConsistencyEnvelope(
            new CheckBlobConsistencyBody($this)
        );
    }
}
