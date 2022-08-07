<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\Mountpoint;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateMountpointResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateMountpointResponse extends SoapResponse
{
    /**
     * Details of the created mountpoint
     * 
     * @Accessor(getter="getMount", setter="setMount")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\Mountpoint")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Mountpoint $mount = NULL;

    /**
     * Constructor
     *
     * @param  Mountpoint $mount
     * @return self
     */
    public function __construct(?Mountpoint $mount = NULL)
    {
        if ($mount instanceof Mountpoint) {
            $this->setMount($mount);
        }
    }

    /**
     * Get mount point
     *
     * @return Mountpoint
     */
    public function getMount(): ?Mountpoint
    {
        return $this->mount;
    }

    /**
     * Set mount point
     *
     * @param  Mountpoint $mount
     * @return self
     */
    public function setMount(Mountpoint $mount): self
    {
        $this->mount = $mount;
        return $this;
    }
}
