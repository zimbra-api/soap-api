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
use Zimbra\Mail\Struct\TagActionSelector;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * TagActionRequest class
 * Perform an action on a tag
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TagActionRequest extends Request
{
    /**
     * Specify action to perform.
     * Caller must supply one of "id" or "tn"
     * Supported operations: "read|!read|color|delete|rename|update|retentionpolicy"
     * If op="update", the caller can specify "name" and/or "color"
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\TagActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private TagActionSelector $action;

    /**
     * Constructor method for TagActionRequest
     *
     * @param  TagActionSelector $action
     * @return self
     */
    public function __construct(TagActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return TagActionSelector
     */
    public function getAction(): TagActionSelector
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  TagActionSelector $action
     * @return self
     */
    public function setAction(TagActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new TagActionEnvelope(
            new TagActionBody($this)
        );
    }
}
