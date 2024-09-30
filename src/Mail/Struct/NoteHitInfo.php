<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SearchHit;

/**
 * NoteHitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NoteHitInfo extends NoteInfo implements SearchHit
{
    /**
     * Sort field value
     *
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $sortField
     * @param  int $revision
     * @param  string $folder
     * @param  int $date
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $bounds
     * @param  int $color
     * @param  string $rgb
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  string $content
     * @param  array $metadatas
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?string $sortField = null,
        ?int $revision = null,
        ?string $folder = null,
        ?int $date = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $bounds = null,
        ?int $color = null,
        ?string $rgb = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        ?string $content = null,
        array $metadatas = []
    ) {
        parent::__construct(
            $id,
            $revision,
            $folder,
            $date,
            $flags,
            $tags,
            $tagNames,
            $bounds,
            $color,
            $rgb,
            $changeDate,
            $modifiedSequence,
            $content,
            $metadatas
        );
        if (null !== $sortField) {
            $this->setSortField($sortField);
        }
    }

    public function setId(string $id): self
    {
        parent::setId($id);
        return $this;
    }

    /**
     * Get sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sortField
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }
}
