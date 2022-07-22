<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\ResponseInterface;

/**
 * ModifyProfileImageResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2013-present by Nguyen Van Nguyen.
 */
class ModifyProfileImageResponse implements ResponseInterface
{
    /**
     * Item ID of profile image
     * 
     * @Accessor(getter="getItemId", setter="setItemId")
     * @SerializedName("itemId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $itemId;

    /**
     * Constructor method for ModifyProfileImageResponse
     *
     * @param  int  $itemId
     * @return self
     */
    public function __construct(?int $itemId = NULL)
    {
        if (NULL !== $itemId) {
            $this->setItemId($itemId);
        }
    }

    /**
     * Gets itemId
     *
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * Sets itemId
     *
     * @param  int $itemId
     * @return self
     */
    public function setItemId(int $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }
}
