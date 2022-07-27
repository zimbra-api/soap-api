<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\VersionInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetVersionInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetVersionInfoResponse implements SoapResponseInterface
{
    /**
     * Version information
     * 
     * @Accessor(getter="getVersionInfo", setter="setVersionInfo")
     * @SerializedName("info")
     * @Type("Zimbra\Account\Struct\VersionInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?VersionInfo $versionInfo = NULL;

    /**
     * Constructor method for GetVersionInfoResponse
     *
     * @param VersionInfo $versionInfo
     * @return self
     */
    public function __construct(?VersionInfo $versionInfo = NULL)
    {
        if ($versionInfo instanceof VersionInfo) {
            $this->setVersionInfo($versionInfo);
        }
    }

    /**
     * Sets versionInfo
     *
     * @param  VersionInfo $signatures
     * @return self
     */
    public function setVersionInfo(VersionInfo $versionInfo): self
    {
        $this->versionInfo = $versionInfo;
        return $this;
    }

    /**
     * Gets versionInfo
     *
     * @return VersionInfo
     */
    public function getVersionInfo(): ?VersionInfo
    {
        return $this->versionInfo;
    }
}
