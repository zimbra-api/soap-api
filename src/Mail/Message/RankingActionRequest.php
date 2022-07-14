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
use Zimbra\Mail\Struct\RankingActionSpec;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RankingActionRequest class
 * Perform an action on the contact ranking table
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RankingActionRequest extends Request
{
    /**
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\RankingActionSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private RankingActionSpec $action;

    /**
     * Constructor method for RankingActionRequest
     *
     * @param  RankingActionSpec $action
     * @return self
     */
    public function __construct(RankingActionSpec $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return RankingActionSpec
     */
    public function getAction(): RankingActionSpec
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  RankingActionSpec $action
     * @return self
     */
    public function setAction(RankingActionSpec $action): self
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
        return new RankingActionEnvelope(
            new RankingActionBody($this)
        );
    }
}