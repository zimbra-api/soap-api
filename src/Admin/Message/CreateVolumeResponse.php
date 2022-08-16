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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\VolumeInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateVolumeResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateVolumeResponse extends SoapResponse
{
    /**
     * Information about the newly created volume
     * 
     * @var VolumeInfo
     */
    #[Accessor(getter: 'getVolume', setter: 'setVolume')]
    #[SerializedName(name: 'volume')]
    #[Type(name: VolumeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $volume;

    /**
     * Constructor
     *
     * @param VolumeInfo $volume
     * @return self
     */
    public function __construct(?VolumeInfo $volume = NULL)
    {
        if ($volume instanceof VolumeInfo) {
            $this->setVolume($volume);
        }
    }

    /**
     * Get the volume.
     *
     * @return VolumeInfo
     */
    public function getVolume(): ?VolumeInfo
    {
        return $this->volume;
    }

    /**
     * Set the volume.
     *
     * @param  VolumeInfo $volume
     * @return self
     */
    public function setVolume(VolumeInfo $volume): self
    {
        $this->volume = $volume;
        return $this;
    }
}
