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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * FileSharedWithMeRequest class
 * File Share With Me
 * This is an internal API, cannot be invoked directly
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FileSharedWithMeRequest extends SoapRequest
{
    /**
     * Action - Create, Edit, Revoke
     * 
     * @var string
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $action;

    /**
     * Name of the file which is to be shared
     * 
     * @var string
     */
    #[Accessor(getter: 'getFileName', setter: 'setFileName')]
    #[SerializedName('filename')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $fileName;

    /**
     * Owner File ID
     * 
     * @var int
     */
    #[Accessor(getter: 'getOwnerFileId', setter: 'setOwnerFileId')]
    #[SerializedName('itemId')]
    #[Type('int')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $ownerFileId;

    /**
     * Owner File UUID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFileUUID', setter: 'setFileUUID')]
    #[SerializedName('ruuid')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $fileUUID;

    /**
     * File Owner Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getFileOwnerName', setter: 'setFileOwnerName')]
    #[SerializedName('owner')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $fileOwnerName;

    /**
     * Permission provided to the file
     * 
     * @var string
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[SerializedName('perm')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $rights;

    /**
     * Content type of the file
     * 
     * @var string
     */
    #[Accessor(getter: 'getContentType', setter: 'setContentType')]
    #[SerializedName('ct')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $contentType;

    /**
     * Actual file size
     * 
     * @var int
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $size;

    /**
     * Remote account owner ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getOwnerAccountId', setter: 'setOwnerAccountId')]
    #[SerializedName('rid')]
    #[Type('string')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $ownerAccountId;

    /**
     * Actual file modified date
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName('d')]
    #[Type('int')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $date;

    /**
     * Constructor
     *
     * @param  string $action
     * @param  string $fileName
     * @param  int $ownerFileId
     * @param  string $fileUUID
     * @param  string $fileOwnerName
     * @param  string $rights
     * @param  string $contentType
     * @param  int $size
     * @param  string $ownerAccountId
     * @param  int $date
     * @return self
     */
    public function __construct(
        string $action = '',
        string $fileName = '',
        int $ownerFileId = 0,
        string $fileUUID = '',
        string $fileOwnerName = '',
        string $rights = '',
        string $contentType = '',
        int $size = 0,
        string $ownerAccountId = '',
        int $date = 0
    )
    {
        $this->setAction($action)
             ->setFileName($fileName)
             ->setOwnerFileId($ownerFileId)
             ->setFileUUID($fileUUID)
             ->setFileOwnerName($fileOwnerName)
             ->setRights($rights)
             ->setContentType($contentType)
             ->setSize($size)
             ->setOwnerAccountId($ownerAccountId)
             ->setDate($date);
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Set string
     *
     * @param  string $fileName
     * @return self
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Get ownerFileId
     *
     * @return int
     */
    public function getOwnerFileId(): int
    {
        return $this->ownerFileId;
    }

    /**
     * Set ownerFileId
     *
     * @param  int $ownerFileId
     * @return self
     */
    public function setOwnerFileId(int $ownerFileId): self
    {
        $this->ownerFileId = $ownerFileId;
        return $this;
    }

    /**
     * Get fileUUID
     *
     * @return string
     */
    public function getFileUUID(): string
    {
        return $this->fileUUID;
    }

    /**
     * Set fileUUID
     *
     * @param  string $fileUUID
     * @return self
     */
    public function setFileUUID(string $fileUUID): self
    {
        $this->fileUUID = $fileUUID;
        return $this;
    }

    /**
     * Get fileOwnerName
     *
     * @return string
     */
    public function getFileOwnerName(): string
    {
        return $this->fileOwnerName;
    }

    /**
     * Set fileOwnerName
     *
     * @param  string $fileOwnerName
     * @return self
     */
    public function setFileOwnerName(string $fileOwnerName): self
    {
        $this->fileOwnerName = $fileOwnerName;
        return $this;
    }

    /**
     * Get rights
     *
     * @return string
     */
    public function getRights(): string
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get ownerAccountId
     *
     * @return string
     */
    public function getOwnerAccountId(): string
    {
        return $this->ownerAccountId;
    }

    /**
     * Set ownerAccountId
     *
     * @param  string $ownerAccountId
     * @return self
     */
    public function setOwnerAccountId(string $ownerAccountId): self
    {
        $this->ownerAccountId = $ownerAccountId;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FileSharedWithMeEnvelope(
            new FileSharedWithMeBody($this)
        );
    }
}
