<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * UnexpectedBlobInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailboxBlobConsistency
{
    /**
     * Mailbox ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $id;

    /**
     * Information about missing blobs
     * 
     * @Accessor(getter="getMissingBlobs", setter="setMissingBlobs")
     * @SerializedName("missingBlobs")
     * @Type("array<Zimbra\Admin\Struct\MissingBlobInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="item", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getMissingBlobs', setter: 'setMissingBlobs')]
    #[SerializedName(name: 'missingBlobs')]
    #[Type(name: 'array<Zimbra\Admin\Struct\MissingBlobInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'item', namespace: 'urn:zimbraAdmin')]
    private $missingBlobs = [];

    /**
     * Information about items with incorrect sizes
     * 
     * @Accessor(getter="getIncorrectSizes", setter="setIncorrectSizes")
     * @SerializedName("incorrectSizes")
     * @Type("array<Zimbra\Admin\Struct\IncorrectBlobSizeInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="item", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getIncorrectSizes', setter: 'setIncorrectSizes')]
    #[SerializedName(name: 'incorrectSizes')]
    #[Type(name: 'array<Zimbra\Admin\Struct\IncorrectBlobSizeInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'item', namespace: 'urn:zimbraAdmin')]
    private $incorrectSizes = [];

    /**
     * Information about unexpected blobs
     * 
     * @Accessor(getter="getUnexpectedBlobs", setter="setUnexpectedBlobs")
     * @SerializedName("unexpectedBlobs")
     * @Type("array<Zimbra\Admin\Struct\UnexpectedBlobInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="blob", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUnexpectedBlobs', setter: 'setUnexpectedBlobs')]
    #[SerializedName(name: 'unexpectedBlobs')]
    #[Type(name: 'array<Zimbra\Admin\Struct\UnexpectedBlobInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'blob', namespace: 'urn:zimbraAdmin')]
    private $unexpectedBlobs = [];

    /**
     * Information about items with incorrect revisions
     * 
     * @Accessor(getter="getIncorrectRevisions", setter="setIncorrectRevisions")
     * @SerializedName("incorrectRevisions")
     * @Type("array<Zimbra\Admin\Struct\IncorrectBlobRevisionInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="item", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getIncorrectRevisions', setter: 'setIncorrectRevisions')]
    #[SerializedName(name: 'incorrectRevisions')]
    #[Type(name: 'array<Zimbra\Admin\Struct\IncorrectBlobRevisionInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'item', namespace: 'urn:zimbraAdmin')]
    private $incorrectRevisions = [];

    /**
     * Information about used blobs
     * 
     * @Accessor(getter="getUsedBlobs", setter="setUsedBlobs")
     * @SerializedName("usedBlobs")
     * @Type("array<Zimbra\Admin\Struct\UsedBlobInfo>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="item", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUsedBlobs', setter: 'setUsedBlobs')]
    #[SerializedName(name: 'usedBlobs')]
    #[Type(name: 'array<Zimbra\Admin\Struct\UsedBlobInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'item', namespace: 'urn:zimbraAdmin')]
    private $usedBlobs = [];

    /**
     * Constructor
     * 
     * @param  int $id
     * @param  array  $missingBlobs
     * @param  array  $incorrectSizes
     * @param  array  $unexpectedBlobs
     * @param  array  $incorrectRevisions
     * @param  array  $usedBlobs
     * @return self
     */
    public function __construct(
        int $id = 0,
        array $missingBlobs = [],
        array $incorrectSizes = [],
        array $unexpectedBlobs = [],
        array $incorrectRevisions = [],
        array $usedBlobs = []
    )
    {
        $this->setId($id)
             ->setMissingBlobs($missingBlobs)
             ->setIncorrectSizes($incorrectSizes)
             ->setUnexpectedBlobs($unexpectedBlobs)
             ->setIncorrectRevisions($incorrectRevisions)
             ->setUsedBlobs($usedBlobs);
    }

    /**
     * Get mailbox ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set mailbox ID
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set missing blobs
     *
     * @param  array $blobs
     * @return self
     */
    public function setMissingBlobs(array $blobs): self
    {
        $this->missingBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof MissingBlobInfo);
        return $this;
    }

    /**
     * Get missing blobs
     *
     * @return array
     */
    public function getMissingBlobs(): array
    {
        return $this->missingBlobs;
    }

    /**
     * Set incorrect sizes
     *
     * @param  array $sizes
     * @return self
     */
    public function setIncorrectSizes(array $sizes): self
    {
        $this->incorrectSizes = array_filter($sizes, static fn ($size) => $size instanceof IncorrectBlobSizeInfo);
        return $this;
    }

    /**
     * Get incorrect sizes
     *
     * @return array
     */
    public function getIncorrectSizes(): array
    {
        return $this->incorrectSizes;
    }

    /**
     * Set unexpected blobs
     *
     * @param  array $blobs
     * @return self
     */
    public function setUnexpectedBlobs(array $blobs): self
    {
        $this->unexpectedBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof UnexpectedBlobInfo);
        return $this;
    }

    /**
     * Get unexpected blobs
     *
     * @return array
     */
    public function getUnexpectedBlobs(): array
    {
        return $this->unexpectedBlobs;
    }

    /**
     * Set incorrect revisions
     *
     * @param  array $revisions
     * @return self
     */
    public function setIncorrectRevisions(array $revisions): self
    {
        $this->incorrectRevisions = array_filter($revisions, static fn ($revision) => $revision instanceof IncorrectBlobRevisionInfo);
        return $this;
    }

    /**
     * Get incorrect revisions
     *
     * @return array
     */
    public function getIncorrectRevisions(): array
    {
        return $this->incorrectRevisions;
    }

    /**
     * Set used blobs
     *
     * @param  array $blobs
     * @return self
     */
    public function setUsedBlobs(array $blobs): self
    {
        $this->usedBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof UsedBlobInfo);
        return $this;
    }

    /**
     * Get used blobs
     *
     * @return array
     */
    public function getUsedBlobs(): array
    {
        return $this->usedBlobs;
    }
}
