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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * VolumeIdAndProgress struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     * 
     * @param string $volumeId
     * @param string $progress
     * @return self
     */
    public function __construct(string $volumeId = '', string $progress = '')
    {
        $this->setVolumeId($volumeId)
             ->setProgress($progress);
    }

    /**
     * Set the volumeId
     *
     * @return string
     */
    public function getVolumeId(): string
    {
        return $this->volumeId;
    }

    /**
     * Set the volumeId
     *
     * @param  string $volumeId
     * @return self
     */
    public function setVolumeId(string $volumeId): self
    {
        $this->volumeId = $volumeId;
        return $this;
    }

    /**
     * Set the progress
     *
     * @return string
     */
    public function getProgress(): string
    {
        return $this->progress;
    }

    /**
     * Set the progress
     *
     * @param  string $progress
     * @return self
     */
    public function setProgress(string $progress): self
    {
        $this->progress = $progress;
        return $this;
    }
}
