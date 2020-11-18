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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};

/**
 * CreateVolumeRequest class
 * Create a volume
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateVolumeRequest")
 */
class CreateVolumeRequest implements RequestInterface
{
    /**
     * Volume information
     * @Accessor(getter="getVolume", setter="setVolume")
     * @SerializedName("volume")
     * @Type("Zimbra\Admin\Struct\VolumeInfo")
     * @XmlElement
     */
    private $volume;

    /**
     * Constructor method for CreateVolumeRequest
     * @param VolumeInfo  $volume
     * @return self
     */
    public function __construct(
        VolumeInfo $volume
    )
    {
        $this->setVolume($volume);
    }

    /**
     * Gets volume
     *
     * @return VolumeInfo
     */
    public function getVolume(): VolumeInfo
    {
        return $this->volume;
    }

    /**
     * Sets volume
     *
     * @param  VolumeInfo $name
     * @return self
     */
    public function setVolume(VolumeInfo $volume): self
    {
        $this->volume = $volume;
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new CreateVolumeEnvelope(
            new CreateVolumeBody($this)
        );
    }
}
