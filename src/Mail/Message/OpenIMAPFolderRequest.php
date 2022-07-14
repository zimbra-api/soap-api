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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * OpenIMAPFolderRequest class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class OpenIMAPFolderRequest extends Request
{
    /**
     * The ID of the folder to open
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * The maximum number of results to return
     * 
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Cursor specifying the last item on the previous results page
     * 
     * @Accessor(getter="getCursor", setter="setCursor")
     * @SerializedName("cursor")
     * @Type("Zimbra\Mail\Struct\ImapCursorInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ImapCursorInfo $cursor = NULL;

    /**
     * Constructor method for OpenIMAPFolderRequest
     *
     * @param  string $folderId
     * @param  int $limit
     * @param  ImapCursorInfo $cursor
     * @return self
     */
    public function __construct(
        string $folderId = '',
        int $limit = 0,
        ?ImapCursorInfo $cursor = NULL
    )
    {
        $this->setFolderId($folderId)
             ->setLimit($limit);
        if ($cursor instanceof ImapCursorInfo) {
            $this->setCursor($cursor);
        }
    }

    /**
     * Sets limit
     *
     * @param  array $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
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
     * Gets cursor
     *
     * @return ImapCursorInfo
     */
    public function getCursor(): ?ImapCursorInfo
    {
        return $this->cursor;
    }

    /**
     * Sets cursor
     *
     * @param  ImapCursorInfo $cursor
     * @return self
     */
    public function setCursor(ImapCursorInfo $cursor): self
    {
        $this->cursor = $cursor;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new OpenIMAPFolderEnvelope(
            new OpenIMAPFolderBody($this)
        );
    }
}