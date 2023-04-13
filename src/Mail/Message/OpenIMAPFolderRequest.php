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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * OpenIMAPFolderRequest class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class OpenIMAPFolderRequest extends SoapRequest
{
    /**
     * The ID of the folder to open
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * The maximum number of results to return
     * 
     * @var int
     */
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName('limit')]
    #[Type('int')]
    #[XmlAttribute]
    private $limit;

    /**
     * Cursor specifying the last item on the previous results page
     * 
     * @var ImapCursorInfo
     */
    #[Accessor(getter: 'getCursor', setter: 'setCursor')]
    #[SerializedName('cursor')]
    #[Type(ImapCursorInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?ImapCursorInfo $cursor;

    /**
     * Constructor
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
        $this->cursor = $cursor;
    }

    /**
     * Set limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Get limit
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
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

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new OpenIMAPFolderEnvelope(
            new OpenIMAPFolderBody($this)
        );
    }
}
