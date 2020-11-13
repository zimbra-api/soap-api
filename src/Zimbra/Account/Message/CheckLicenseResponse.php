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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Enum\CheckLicenseStatus;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckLicenseResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckLicenseResponse", namespace="urn:zimbraAccount")
 */
class CheckLicenseResponse implements ResponseInterface
{
    /**
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\CheckLicenseStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for CheckLicenseResponse
     * @param  string $status Status of access to requested licensed feature.
     * @return self
     */
    public function __construct(CheckLicenseStatus $status)
    {
        $this->setStatus($status);
    }

    /**
     * Gets status
     *
     * @return CheckLicenseStatus
     */
    public function getStatus(): CheckLicenseStatus
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  CheckLicenseStatus $status
     * @return self
     */
    public function setStatus(CheckLicenseStatus $status): self
    {
        $this->status = $status;
        return $this;
    }
}
