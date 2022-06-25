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
use Zimbra\Soap\ResponseInterface;

/**
 * CreateMountpointResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateMountpointResponse implements ResponseInterface
{
    /**
     * Details of the created mountpoint
     * @Accessor(getter="getMount", setter="setMount")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\Mountpoint")
     * @XmlElement
     */
    private Mountpoint $mount;

    /**
     * Constructor method for CreateMountpointResponse
     *
     * @param  Mountpoint $mount
     * @return self
     */
    public function __construct(Mountpoint $mount)
    {
        $this->setMount($mount);
    }

    /**
     * Gets mount point
     *
     * @return Mountpoint
     */
    public function getMount(): Mountpoint
    {
        return $this->mount;
    }

    /**
     * Sets mount point
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
