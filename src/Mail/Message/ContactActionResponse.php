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
use Zimbra\Common\Struct\SoapResponse;

/**
 * ContactActionResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2020-present by Nguyen Van Nguyen.
 */
class ContactActionResponse extends SoapResponse
{
    /**
     * Action result
     *
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\FolderActionResult")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var FolderActionResult
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName("action")]
    #[Type(FolderActionResult::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?FolderActionResult $action;

    /**
     * Constructor
     *
     * @param  FolderActionResult $action
     * @return self
     */
    public function __construct(?FolderActionResult $action = null)
    {
        $this->action = $action;
        if ($action instanceof FolderActionResult) {
            $this->setAction($action);
        }
    }

    /**
     * Get action
     *
     * @return FolderActionResult
     */
    public function getAction(): ?FolderActionResult
    {
        return $this->action;
    }

    /**
     * Set action
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
