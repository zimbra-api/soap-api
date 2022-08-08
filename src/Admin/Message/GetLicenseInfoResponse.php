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
use Zimbra\Admin\Struct\LicenseExpirationInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetLicenseInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetLicenseInfoResponse extends SoapResponse
{
    /**
     * License expiration information
     * 
     * @Accessor(getter="getExpiration", setter="setExpiration")
     * @SerializedName("expiration")
     * @Type("Zimbra\Admin\Struct\LicenseExpirationInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var LicenseExpirationInfo
     */
    private $expiration;

    /**
     * Constructor
     *
     * @param LicenseExpirationInfo $expiration
     * @return self
     */
    public function __construct(?LicenseExpirationInfo $expiration = NULL)
    {
        if ($expiration instanceof LicenseExpirationInfo) {
            $this->setExpiration($expiration);
        }
    }

    /**
     * Get the expiration.
     *
     * @return LicenseExpirationInfo
     */
    public function getExpiration(): ?LicenseExpirationInfo
    {
        return $this->expiration;
    }

    /**
     * Set the expiration.
     *
     * @param  LicenseExpirationInfo $expiration
     * @return self
     */
    public function setExpiration(LicenseExpirationInfo $expiration): self
    {
        $this->expiration = $expiration;
        return $this;
    }
}
