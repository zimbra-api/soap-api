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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\CurrentVolumeInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetCurrentVolumesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCurrentVolumesResponse implements ResponseInterface
{
    /**
     * Current volume information.
     * Entry for secondary message type (2) is optional
     * 
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @SerializedName("volume")
     * @Type("array<Zimbra\Admin\Struct\CurrentVolumeInfo>")
     * @XmlList(inline = true, entry = "volume")
     */
    private $volumes;

    /**
     * Constructor method for GetCurrentVolumesResponse
     *
     * @param array $volumes
     * @return self
     */
    public function __construct(array $volumes = [])
    {
        $this->setVolumes($volumes);
    }

    /**
     * Add a volume information
     *
     * @param  CurrentVolumeInfo $volume
     * @return self
     */
    public function addVolume(CurrentVolumeInfo $volume): self
    {
        $this->volumes[] = $volume;
        return $this;
    }

    /**
     * Sets volume informations
     *
     * @param  array $volumes
     * @return self
     */
    public function setVolumes(array $volumes): self
    {
        $this->volumes = [];
        foreach ($volumes as $volume) {
            if ($volume instanceof CurrentVolumeInfo) {
                $this->volumes[] = $volume;
            }
        }
        return $this;
    }

    /**
     * Gets volume informations
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }
}
