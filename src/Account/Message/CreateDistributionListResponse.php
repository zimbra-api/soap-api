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
use Zimbra\Account\Struct\DLInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateDistributionListResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateDistributionListResponse implements ResponseInterface
{
    /**
     * Information about the newly created distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Account\Struct\DLInfo")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private DLInfo $dl;

    /**
     * Constructor method for CreateDistributionListResponse
     *
     * @param DLInfo $dl
     * @return self
     */
    public function __construct(DLInfo $dl)
    {
        $this->setDl($dl);
    }

    /**
     * Gets the dl.
     *
     * @return DLInfo
     */
    public function getDl(): DLInfo
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
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
