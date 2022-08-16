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
use Zimbra\Common\Struct\SoapResponse;

/**
 * RenameUCServiceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RenameUCServiceResponse extends SoapResponse
{
    /**
     * Information about ucservice
     * 
     * @var UCServiceInfo
     */
    #[Accessor(getter: 'getUCService', setter: 'setUCService')]
    #[SerializedName(name: 'ucservice')]
    #[Type(name: UCServiceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $ucService;

    /**
     * Constructor
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
