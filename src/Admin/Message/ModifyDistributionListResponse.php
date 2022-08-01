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
use Zimbra\Admin\Struct\DistributionListInfo as DLInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * ModifyDistributionListResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyDistributionListResponse implements SoapResponseInterface
{
    /**
     * Information about distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?DLInfo $dl = NULL;

    /**
     * Constructor method for ModifyDistributionListResponse
     *
     * @param DLInfo $dl
     * @return self
     */
    public function __construct(?DLInfo $dl = NULL)
    {
        if ($dl instanceof DLInfo) {
            $this->setDl($dl);
        }
    }

    /**
     * Get the dl.
     *
     * @return DLInfo
     */
    public function getDl(): ?DLInfo
    {
        return $this->dl;
    }

    /**
     * Set the dl.
     *
     * @param  DLInfo $dl
     * @return self
     */
    public function setDl(DLInfo $dl): self
    {
        $this->dl = $dl;
        return $this;
    }
}
