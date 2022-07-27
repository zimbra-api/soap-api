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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Mail\Struct\ImapCursorInfo;
use Zimbra\Mail\Struct\ImapMessageInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * OpenIMAPFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class OpenIMAPFolderResponse implements SoapResponseInterface
{
    /**
     * Flag whether can be cached
     * 
     * @Accessor(getter="getHasMore", setter="setHasMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $hasMore;

    /**
     * Messages
     * 
     * @Accessor(getter="getMessages", setter="setMessages")
     * @SerializedName("folder")
     * @Type("array<Zimbra\Mail\Struct\ImapMessageInfo>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="m", namespace="urn:zimbraMail")
     */
    private $messages = [];

    /**
     * Cursor to be used by the next request, if more results exist
     * 
     * @Accessor(getter="getCursor", setter="setCursor")
     * @SerializedName("cursor")
     * @Type("Zimbra\Mail\Struct\ImapCursorInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ImapCursorInfo $cursor = NULL;

    /**
     * Constructor method for OpenIMAPFolderResponse
     *
     * @param  array $messages
     * @param  bool $hasMore
     * @param  ImapCursorInfo $cursor
     * @return self
     */
    public function __construct(
        array $messages = [],
        ?bool $hasMore = NULL,
        ?ImapCursorInfo $cursor = NULL
    )
    {
        $this->setMessages($messages);
        if (NULL !== $hasMore) {
            $this->setHasMore($hasMore);
        }
        if ($cursor instanceof ImapCursorInfo) {
            $this->setCursor($cursor);
        }
    }

    /**
     * Add message
     *
     * @param  ImapMessageInfo $message
     * @return self
     */
    public function addMessage(ImapMessageInfo $message): self
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * Sets messages
     *
     * @param  array $messages
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = array_filter($messages, static fn ($message) => $message instanceof ImapMessageInfo);
        return $this;
    }

    /**
     * Gets messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Gets hasMore
     *
     * @return bool
     */
    public function getHasMore(): ?bool
    {
        return $this->hasMore;
    }

    /**
     * Sets hasMore
     *
     * @param  bool $hasMore
     * @return self
     */
    public function setHasMore(bool $hasMore): self
    {
        $this->hasMore = $hasMore;
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
}
