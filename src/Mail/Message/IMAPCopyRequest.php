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
use Zimbra\Common\Enum\MailItemType;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * IMAPCopyRequest class
 * Return the count of recent items in the specified folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class IMAPCopyRequest extends Request
{
    /**
     * Comma separated list of integer ids
     * 
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     */
    private $ids;

    /**
     * Mail item type.
     * Valid values are case insensitive types from MailItemType enum
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("t")
     * @Type("Zimbra\Common\Enum\MailItemType")
     * @XmlAttribute
     */
    private $type;

    /**
     * Target folder ID
     * 
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("integer")
     * @XmlAttribute
     */
    private $folder;

    /**
     * Constructor method for IMAPCopyRequest
     *
     * @param  string $ids
     * @param  MailItemType $type
     * @param  int $folder
     * @return self
     */
    public function __construct(
        string $ids = '',
        ?MailItemType $type = NULL,
        int $folder = 0
    )
    {
        $this->setIds($ids)
             ->setType($type ?? MailItemType::MESSAGE())
             ->setFolder($folder);
    }

    /**
     * Gets folder
     *
     * @return int
     */
    public function getFolder(): int
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  int $folder
     * @return self
     */
    public function setFolder(int $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Gets ids
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * Sets ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * Gets type
     *
     * @return MailItemType
     */
    public function getType(): MailItemType
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  MailItemType $type
     * @return self
     */
    public function setType(MailItemType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new IMAPCopyEnvelope(
            new IMAPCopyBody($this)
        );
    }
}