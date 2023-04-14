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
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllVolumesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllVolumesResponse extends SoapResponse
{
    /**
     * Information about volumes
     * 
     * @var array
     */
    #[Accessor(getter: 'getVolumes', setter: 'setVolumes')]
    #[Type('array<Zimbra\Admin\Struct\VolumeInfo>')]
    #[XmlList(inline: true, entry: 'volume', namespace: 'urn:zimbraAdmin')]
    private $volumes = [];

    /**
     * Constructor
     *
     * @param array $volumes
     * @return self
     */
    public function __construct(array $volumes = [])
    {
        $this->setVolumes($volumes);
    }

    /**
     * Set volumes
     *
     * @param  array $volumes
     * @return self
     */
    public function setVolumes(array $volumes): self
    {
        $this->volumes = array_filter(
            $volumes, static fn ($volume) => $volume instanceof VolumeInfo
        );
        return $this;
    }

    /**
     * Get volumes
     *
     * @return array
     */
    public function getVolumes(): array
    {
        return $this->volumes;
    }
}
