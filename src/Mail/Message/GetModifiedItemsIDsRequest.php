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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetModifiedItemsIDsRequest class
 * Returns the IDs of all items modified since a given change number
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetModifiedItemsIDsRequest extends Request
{
    /**
     * Root folder ID.  If present, we start sync there rather than at folder 11
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("integer")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * value passed by IMAP client in CHANGEDSINCE modifier
     * 
     * @Accessor(getter="getModSeq", setter="setModSeq")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modSeq;

    /**
     * Constructor method for GetModifiedItemsIDsRequest
     *
     * @param  int $folderId
     * @param  int $modSeq
     * @return self
     */
    public function __construct(int $folderId = 0, int $modSeq = 0)
    {
        $this->setFolderId($folderId)
             ->setModSeq($modSeq);
    }

    /**
     * Gets folderId
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  int $folderId
     * @return self
     */
    public function setFolderId(int $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Gets modSeq
     *
     * @return int
     */
    public function getModSeq(): int
    {
        return $this->modSeq;
    }

    /**
     * Sets modSeq
     *
     * @param  int $modSeq
     * @return self
     */
    public function setModSeq(int $modSeq): self
    {
        $this->modSeq = $modSeq;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetModifiedItemsIDsEnvelope(
            new GetModifiedItemsIDsBody($this)
        );
    }
}