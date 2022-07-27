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
use Zimbra\Admin\Struct\VersionInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetVersionInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetVersionInfoResponse implements SoapResponseInterface
{
    /**
     * Version information
     * @Accessor(getter="getInfo", setter="setInfo")
     * @SerializedName("info")
     * @Type("Zimbra\Admin\Struct\VersionInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?VersionInfo $info = NULL;

    /**
     * Constructor method for GetVersionInfoResponse
     *
     * @param VersionInfo $info
     * @return self
     */
    public function __construct(?VersionInfo $info = NULL)
    {
        if ($info instanceof VersionInfo) {
            $this->setInfo($info);
        }
    }

    /**
     * Gets the info.
     *
     * @return VersionInfo
     */
    public function getInfo(): ?VersionInfo
    {
        return $this->info;
    }

    /**
     * Sets the info.
     *
     * @param  VersionInfo $info
     * @return self
     */
    public function setInfo(VersionInfo $info): self
    {
        $this->info = $info;
        return $this;
    }
}
