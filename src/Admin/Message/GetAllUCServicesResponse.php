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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllUCServicesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllUCServicesResponse implements ResponseInterface
{
    /**
     * Information about uc services
     * 
     * @Accessor(getter="getUCServiceList", setter="setUCServiceList")
     * @SerializedName("ucservice")
     * @Type("array<Zimbra\Admin\Struct\UCServiceInfo>")
     * @XmlList(inline=true, entry="ucservice", namespace="urn:zimbraAdmin")
     */
    private $ucServiceList = [];

    /**
     * Constructor method for GetAllUCServicesResponse
     *
     * @param array $ucServiceList
     * @return self
     */
    public function __construct(array $ucServiceList = [])
    {
        $this->setUCServiceList($ucServiceList);
    }

    /**
     * Add a ucService
     *
     * @param  UCServiceInfo $ucService
     * @return self
     */
    public function addUCService(UCServiceInfo $ucService): self
    {
        $this->ucServiceList[] = $ucService;
        return $this;
    }

    /**
     * Sets ucServiceList
     *
     * @param  array $list
     * @return self
     */
    public function setUCServiceList(array $list): self
    {
        $this->ucServiceList = array_filter($list, static fn ($item) => $item instanceof UCServiceInfo);
        return $this;
    }

    /**
     * Gets ucServiceList
     *
     * @return array
     */
    public function getUCServiceList(): array
    {
        return $this->ucServiceList;
    }
}
