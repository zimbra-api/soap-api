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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * VolumeIdAndProgress struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="volumeProgress")
 */
class VolumeIdAndProgress
{
    /**
     * @Accessor(getter="getVolumeId", setter="setVolumeId")
     * @SerializedName("volumeId")
     * @Type("string")
     * @XmlAttribute
     */
    private $volumeId;

    /**
     * @Accessor(getter="getProgress", setter="setProgress")
     * @SerializedName("progress")
     * @Type("string")
     * @XmlAttribute
     */
    private $progress;

    /**
     * Constructor method for VolumeInfo
     * @param string $volumeId
     * @param string $progress
     * @return self
     */
    public function __construct($volumeId, $progress)
    {
        $this->setVolumeId($volumeId)
             ->setProgress($progress);
    }

    /**
     * Sets the volumeId
     *
     * @return string
     */
    public function getVolumeId(): string
    {
        return $this->volumeId;
    }

    /**
     * Sets the volumeId
     *
     * @param  string $volumeId
     * @return self
     */
    public function setVolumeId($volumeId): self
    {
        $this->volumeId = trim($volumeId);
        return $this;
    }

    /**
     * Sets the progress
     *
     * @return string
     */
    public function getProgress(): string
    {
        return $this->progress;
    }

    /**
     * Sets the progress
     *
     * @param  string $progress
     * @return self
     */
    public function setProgress($progress): self
    {
        $this->progress = trim($progress);
        return $this;
    }
}
