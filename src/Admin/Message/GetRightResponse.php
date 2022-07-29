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
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetRightResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetRightResponse implements SoapResponseInterface
{
    /**
     * Right information
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?RightInfo $right = NULL;

    /**
     * Constructor method for GetRightResponse
     * 
     * @param RightInfo $right
     * @return self
     */
    public function __construct(?RightInfo $right = NULL)
    {
        if ($right instanceof RightInfo) {
            $this->setRight($right);
        }
    }

    /**
     * Get the right.
     *
     * @return RightInfo
     */
    public function getRight(): ?RightInfo
    {
        return $this->right;
    }

    /**
     * Set the right.
     *
     * @param  RightInfo $right
     * @return self
     */
    public function setRight(RightInfo $right): self
    {
        $this->right = $right;
        return $this;
    }
}
