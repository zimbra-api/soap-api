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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateTagRequest class
 * Create a tag
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateTagRequest extends SoapRequest
{
    /**
     * Tag specification
     * 
     * @var TagSpec
     */
    #[Accessor(getter: 'getTag', setter: 'setTag')]
    #[SerializedName('tag')]
    #[Type(TagSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?TagSpec $tag;

    /**
     * Constructor
     *
     * @param  TagSpec $tag
     * @return self
     */
    public function __construct(?TagSpec $tag = NULL)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag
     *
     * @return TagSpec
     */
    public function getTag(): TagSpec
    {
        return $this->tag;
    }

    /**
     * Set tag
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateTagEnvelope(
            new CreateTagBody($this)
        );
    }
}
