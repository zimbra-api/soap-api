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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Mail\Struct\{ImapCursorInfo, ImapMessageInfo};
use Zimbra\Common\Struct\SoapResponse;

/**
 * OpenIMAPFolderResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class OpenIMAPFolderResponse extends SoapResponse
{
    /**
     * Flag whether can be cached
     *
     * @var bool
     */
    #[Accessor(getter: "getHasMore", setter: "setHasMore")]
    #[SerializedName("more")]
    #[Type("bool")]
    #[XmlAttribute]
    private $hasMore;

    /**
     * Messages
     *
     * @var array
     */
    #[Accessor(getter: "getMessages", setter: "setMessages")]
    #[SerializedName("folder")]
    #[Type("array<Zimbra\Mail\Struct\ImapMessageInfo>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "m", namespace: "urn:zimbraMail")]
    private $messages = [];

    /**
     * Cursor to be used by the next request, if more results exist
     *
     * @var ImapCursorInfo
     */
    #[Accessor(getter: "getCursor", setter: "setCursor")]
    #[SerializedName("cursor")]
    #[Type(ImapCursorInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ImapCursorInfo $cursor;

    /**
     * Constructor
     *
     * @param  array $messages
     * @param  bool $hasMore
     * @param  ImapCursorInfo $cursor
     * @return self
     */
    public function __construct(
        array $messages = [],
        ?bool $hasMore = null,
        ?ImapCursorInfo $cursor = null
    ) {
        $this->setMessages($messages);
        $this->cursor = $cursor;
        if (null !== $hasMore) {
            $this->setHasMore($hasMore);
        }
    }

    /**
     * Set messages
     *
     * @param  array $messages
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = array_filter(
            $messages,
            static fn($message) => $message instanceof ImapMessageInfo
        );
        return $this;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Get hasMore
     *
     * @return bool
     */
    public function getHasMore(): ?bool
    {
        return $this->hasMore;
    }

    /**
     * Set hasMore
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
     * Get cursor
     *
     * @return ImapCursorInfo
     */
    public function getCursor(): ?ImapCursorInfo
    {
        return $this->cursor;
    }

    /**
     * Set cursor
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
