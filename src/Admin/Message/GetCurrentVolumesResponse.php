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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\CurrentVolumeInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetCurrentVolumesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCurrentVolumesResponse extends SoapResponse
{
    /**
     * Current volume information.
     * Entry for secondary message type (2) is optional
     * 
     * @Accessor(getter="getVolumes", setter="setVolumes")
     * @Type("array<Zimbra\Admin\Struct\CurrentVolumeInfo>")
     * @XmlList(inline=true, entry="volume", namespace="urn:zimbraAdmin")
     */
    private $volumes = [];

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
     * Set volume informations
     *
     * @param  array $volumes
     * @return self
     */
    public function setVolumes(array $volumes): self
    {
        $this->volumes = array_filter($volumes, static fn ($volume) => $volume instanceof CurrentVolumeInfo);
        return $this;
    }

    /**
     * Get volume informations
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }
}
