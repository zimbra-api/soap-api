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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * IMAPCopyRequest class
 * Return the count of recent items in the specified folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IMAPCopyRequest extends SoapRequest
{
    /**
     * Comma separated list of int ids
     * 
     * @var string
     */
    #[Accessor(getter: 'getIds', setter: 'setIds')]
    #[SerializedName('ids')]
    #[Type('string')]
    #[XmlAttribute]
    private $ids;

    /**
     * Mail item type.
     * Valid values are case insensitive types from MailItemType enum
     * 
     * @var MailItemType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('t')]
    #[XmlAttribute]
    private MailItemType $type;

    /**
     * Target folder ID
     * 
     * @var int
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName('l')]
    #[Type('int')]
    #[XmlAttribute]
    private $folder;

    /**
     * Constructor
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
             ->setType($type ?? MailItemType::MESSAGE)
             ->setFolder($folder);
    }

    /**
     * Get folder
     *
     * @return int
     */
    public function getFolder(): int
    {
        return $this->folder;
    }

    /**
     * Set folder
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
     * Get ids
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->ids;
    }

    /**
     * Set ids
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
     * Get type
     *
     * @return MailItemType
     */
    public function getType(): MailItemType
    {
        return $this->type;
    }

    /**
     * Set type
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new IMAPCopyEnvelope(
            new IMAPCopyBody($this)
        );
    }
}
