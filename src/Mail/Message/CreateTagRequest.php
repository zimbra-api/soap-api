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
use Zimbra\Mail\Struct\TagSpec;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * CreateTagRequest class
 * Create a tag
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateTagRequest extends Request
{
    /**
     * Tag specification
     * @Accessor(getter="getTag", setter="setTag")
     * @SerializedName("tag")
     * @Type("Zimbra\Mail\Struct\TagSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?TagSpec $tag = NULL;

    /**
     * Constructor method for CreateTagRequest
     *
     * @param  TagSpec $tag
     * @return self
     */
    public function __construct(?TagSpec $tag = NULL)
    {
        if ($tag instanceof TagSpec) {
            $this->setTag($tag);
        }
    }

    /**
     * Gets tag
     *
     * @return TagSpec
     */
    public function getTag(): TagSpec
    {
        return $this->tag;
    }

    /**
     * Sets tag
     *
     * @param  TagSpec $tag
     * @return self
     */
    public function setTag(TagSpec $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CreateTagEnvelope(
            new CreateTagBody($this)
        );
    }
}
