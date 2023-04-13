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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * TagActionRequest class
 * Perform an action on a tag
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TagActionRequest extends SoapRequest
{
    /**
     * Specify action to perform.
     * Caller must supply one of "id" or "tn"
     * Supported operations: "read|!read|color|delete|rename|update|retentionpolicy"
     * If op="update", the caller can specify "name" and/or "color"
     * 
     * @var TagActionSelector
     */
    #[Accessor(getter: 'getAction', setter: 'setAction')]
    #[SerializedName('action')]
    #[Type(TagActionSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private TagActionSelector $action;

    /**
     * Constructor
     *
     * @param  TagActionSelector $action
     * @return self
     */
    public function __construct(TagActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return TagActionSelector
     */
    public function getAction(): TagActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new TagActionEnvelope(
            new TagActionBody($this)
        );
    }
}
