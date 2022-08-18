<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\AttributeName;

/**
 * ConversationSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationSpec
{
    /**
     * Conversation ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * if value is "1" or "all" the full expanded message structure is inlined for the
     * first (or for all) messages in the conversation.
     * 
     * @var string
     */
    #[Accessor(getter: 'getInlineRule', setter: 'setInlineRule')]
    #[SerializedName('fetch')]
    #[Type('string')]
    #[XmlAttribute]
    private $inlineRule;

    /**
     * Set to return defanged HTML content by default.  (default is unset)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantHtml', setter: 'setWantHtml')]
    #[SerializedName('html')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantHtml;

    /**
     * Maximum inlined length
     * 
     * @var int
     */
    #[Accessor(getter: 'getMaxInlinedLength', setter: 'setMaxInlinedLength')]
    #[SerializedName('max')]
    #[Type('int')]
    #[XmlAttribute]
    private $maxInlinedLength;

    /**
     * Set to return group info (isGroup and exp flags) on <b>&lt;e></b> elements in the
     * response (default is unset.)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNeedCanExpand', setter: 'setNeedCanExpand')]
    #[SerializedName('needExp')]
    #[Type('bool')]
    #[XmlAttribute]
    private $needCanExpand;

    /**
     * Requested headers.  if <header>s are requested, any matching headers are
     * inlined into the response (not available when raw is set)
     * 
     * @var array
     */
    #[Accessor(getter: 'getHeaders', setter: 'setHeaders')]
    #[Type('array<Zimbra\Common\Struct\AttributeName>')]
    #[XmlList(inline: true, entry: 'header', namespace: 'urn:zimbraMail')]
    private $headers = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $inlineRule
     * @param  bool $wantHtml
     * @param  int $maxInlinedLength
     * @param  bool $needCanExpand
     * @param  array $headers
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $inlineRule = NULL,
        ?bool $wantHtml = NULL,
        ?int $maxInlinedLength = NULL,
        ?bool $needCanExpand = NULL,
        array $headers = []
    )
    {
        $this->setHeaders($headers);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $inlineRule) {
            $this->setInlineRule($inlineRule);
        }
        if (NULL !== $wantHtml) {
            $this->setWantHtml($wantHtml);
        }
        if (NULL !== $maxInlinedLength) {
            $this->setMaxInlinedLength($maxInlinedLength);
        }
        if (NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get inlineRule
     *
     * @return string
     */
    public function getInlineRule(): ?string
    {
        return $this->inlineRule;
    }

    /**
     * Set inlineRule
     *
     * @param  string $inlineRule
     * @return self
     */
    public function setInlineRule(string $inlineRule): self
    {
        $this->inlineRule = $inlineRule;
        return $this;
    }

    /**
     * Get wantHtml
     *
     * @return bool
     */
    public function getWantHtml(): ?bool
    {
        return $this->wantHtml;
    }

    /**
     * Set wantHtml
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml(bool $wantHtml): self
    {
        $this->wantHtml = $wantHtml;
        return $this;
    }

    /**
     * Get maxInlinedLength
     *
     * @return int
     */
    public function getMaxInlinedLength(): ?int
    {
        return $this->maxInlinedLength;
    }

    /**
     * Set maxInlinedLength
     *
     * @param  int $maxInlinedLength
     * @return self
     */
    public function setMaxInlinedLength(int $maxInlinedLength): self
    {
        $this->maxInlinedLength = $maxInlinedLength;
        return $this;
    }

    /**
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter($headers, static fn ($header) => $header instanceof AttributeName);
        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Get needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set needCanExpand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }
}
