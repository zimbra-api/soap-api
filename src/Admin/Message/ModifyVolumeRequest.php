<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Soap\Request;

/**
 * ModifyVolumeRequest class
 * Modify volume 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyVolumeRequest extends Request
{
    /**
     * Volume ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Volume information
     * @Accessor(getter="getVolume", setter="setVolume")
     * @SerializedName("volume")
     * @Type("Zimbra\Admin\Struct\VolumeInfo")
     * @XmlElement
     */
    private VolumeInfo $volume;

    /**
     * Constructor method for ModifyVolumeRequest
     * 
     * @param int $id
     * @param VolumeInfo $volume
     * @return self
     */
    public function __construct(int $id, VolumeInfo $volume)
    {
        $this->setId($id)
             ->setVolume($volume);
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets the data source.
     *
     * @return VolumeInfo
     */
    public function getVolume(): VolumeInfo
    {
        return $this->volume;
    }

    /**
     * Sets the data source
     *
     * @param  VolumeInfo $volume
     * @return self
     */
    public function setVolume(VolumeInfo $volume): self
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyVolumeEnvelope)) {
            $this->envelope = new ModifyVolumeEnvelope(
                new ModifyVolumeBody($this)
            );
        }
    }
}
