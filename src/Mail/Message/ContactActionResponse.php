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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\FolderActionResult;
use Zimbra\Soap\ResponseInterface;

/**
 * ContactActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2013-present by Nguyen Van Nguyen.
 */
class ContactActionResponse implements ResponseInterface
{
    /**
     * Action result
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\FolderActionResult")
     * @XmlElement
     */
    private FolderActionResult $action;

    /**
     * Constructor method for ContactActionResponse
     *
     * @param  FolderActionResult $action
     * @return self
     */
    public function __construct(FolderActionResult $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return FolderActionResult
     */
    public function getAction(): FolderActionResult
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  FolderActionResult $action
     * @return self
     */
    public function setAction(FolderActionResult $action): self
    {
        $this->action = $action;
        return $this;
    }
}
