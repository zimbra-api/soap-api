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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * RenameUCServiceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="RenameUCServiceResponse")
 */
class RenameUCServiceResponse implements ResponseInterface
{
    /**
     * Information about ucservice
     * @Accessor(getter="getUCService", setter="setUCService")
     * @SerializedName("ucservice")
     * @Type("Zimbra\Admin\Struct\UCServiceInfo")
     * @XmlElement
     */
    private $ucService;

    /**
     * Constructor method for RenameUCServiceResponse
     * @param UCServiceInfo $ucService
     * @return self
     */
    public function __construct(UCServiceInfo $ucService)
    {
        $this->setUCService($ucService);
    }

    /**
     * Gets the ucService.
     *
     * @return UCServiceInfo
     */
    public function getUCService(): UCServiceInfo
    {
        return $this->ucService;
    }

    /**
     * Sets the ucService.
     *
     * @param  UCServiceInfo $ucService
     * @return self
     */
    public function setUCService(UCServiceInfo $ucService): self
    {
        $this->ucService = $ucService;
        return $this;
    }
}
