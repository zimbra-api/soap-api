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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetModifiedItemsIDsRequest class
 * Returns the IDs of all items modified since a given change number
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetModifiedItemsIDsRequest extends SoapRequest
{
    /**
     * Root folder ID. If present, we start sync there rather than at folder 11
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Value passed by IMAP client in CHANGEDSINCE modifier
     * 
     * @var int
     */
    #[Accessor(getter: 'getModSeq', setter: 'setModSeq')]
    #[SerializedName('ms')]
    #[Type('int')]
    #[XmlAttribute]
    private $modSeq;

    /**
     * Constructor
     *
     * @param  string $folderId
     * @param  int $modSeq
     * @return self
     */
    public function __construct(string $folderId = '', int $modSeq = 0)
    {
        $this->setFolderId($folderId)
             ->setModSeq($modSeq);
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
     * Get modSeq
     *
     * @return int
     */
    public function getModSeq(): int
    {
        return $this->modSeq;
    }

    /**
     * Set modSeq
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetModifiedItemsIDsEnvelope(
            new GetModifiedItemsIDsBody($this)
        );
    }
}
