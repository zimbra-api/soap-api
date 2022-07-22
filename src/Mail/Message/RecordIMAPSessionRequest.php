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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\ImapCursorInfo;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * RecordIMAPSessionRequest class
 * Record that an IMAP client has seen all the messages in this folder as they
 * are at this time.
 * This is used to determine which messages are considered by IMAP to be RECENT.
 * This is achieved by invoking Mailbox::recordImapSession for the specified folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecordIMAPSessionRequest extends Request
{
    /**
     * The ID of the folder to record
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Constructor method for RecordIMAPSessionRequest
     *
     * @param  string $folderId
     * @return self
     */
    public function __construct(string $folderId = '')
    {
        $this->setFolderId($folderId);
    }

    /**
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RecordIMAPSessionEnvelope(
            new RecordIMAPSessionBody($this)
        );
    }
}
