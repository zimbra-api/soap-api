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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * FolderActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FolderActionResponse implements SoapResponseInterface
{
    /**
     * Folder action result
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\FolderActionResult")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?FolderActionResult $action = NULL;

    /**
     * Constructor method for FolderActionResponse
     *
     * @param  FolderActionResult $action
     * @return self
     */
    public function __construct(?FolderActionResult $action = NULL)
    {
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
