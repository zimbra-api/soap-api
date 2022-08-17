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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckBlobConsistencyRequest extends SoapRequest
{
    /**
     * Set checkSize to 0 (false) to avoid the CPU overhead of uncompressing
     * compressed blobs in order to calculate size.
     * 
     * @Accessor(getter="getCheckSize", setter="setCheckSize")
     * @SerializedName("checkSize")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCheckSize', setter: 'setCheckSize')]
    #[SerializedName(name: 'checkSize')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $checkSize;

    /**
     * If set a complete list of all blobs used by the mailbox(es) is returned
     * 
     * @Accessor(getter="getReportUsedBlobs", setter="setReportUsedBlobs")
     * @SerializedName("reportUsedBlobs")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getReportUsedBlobs', setter: 'setReportUsedBlobs')]
    #[SerializedName(name: 'reportUsedBlobs')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $reportUsedBlobs;

    /**
     * Volumes
     * 
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="volume", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getVolumes', setter: 'setVolumes')]
    #[Type(name: 'array<Zimbra\Admin\Struct\IntIdAttr>')]
    #[XmlList(inline: true, entry: 'volume', namespace: 'urn:zimbraAdmin')]
    private $volumes = [];

    /**
     * Mailboxes
     * 
     * @Accessor(getter="getMailboxes", setter="setMailboxes")
     * @Type("array<Zimbra\Admin\Struct\IntIdAttr>")
     * @XmlList(inline=true, entry="mbox", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getMailboxes', setter: 'setMailboxes')]
    #[Type(name: 'array<Zimbra\Admin\Struct\IntIdAttr>')]
    #[XmlList(inline: true, entry: 'mbox', namespace: 'urn:zimbraAdmin')]
    private $mailboxes = [];

    /**
     * Constructor
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
     * Get check size
     *
     * @return bool
     */
    public function getCheckSize(): ?bool
    {
        return $this->checkSize;
    }

    /**
     * Set check size
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
     * Get report used blobs
     *
     * @return bool
     */
    public function getReportUsedBlobs(): ?bool
    {
        return $this->reportUsedBlobs;
    }

    /**
     * Set report used blobs
     *
     * @param  bool $reportUsedBlobs
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
     * Set volume array
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
     * Get volume array
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
     * Set mailbox array
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
     * Get mailbox array
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        return $this->mailboxes;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckBlobConsistencyEnvelope(
            new CheckBlobConsistencyBody($this)
        );
    }
}
