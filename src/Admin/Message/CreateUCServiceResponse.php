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
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * CreateUCServiceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateUCServiceResponse implements SoapResponseInterface
{
    /**
     * Information about the newly created uc service
     * @Accessor(getter="getUCService", setter="setUCService")
     * @SerializedName("ucservice")
     * @Type("Zimbra\Admin\Struct\UCServiceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?UCServiceInfo $ucService = NULL;

    /**
     * Constructor method for CreateUCServiceResponse
     *
     * @param UCServiceInfo $ucService
     * @return self
     */
    public function __construct(?UCServiceInfo $ucService = NULL)
    {
        if ($ucService instanceof UCServiceInfo) {
            $this->setUCService($ucService);
        }
    }

    /**
     * Get the ucService.
     *
     * @return UCServiceInfo
     */
    public function getUCService(): ?UCServiceInfo
    {
        return $this->ucService;
    }

    /**
     * Set the ucService.
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
