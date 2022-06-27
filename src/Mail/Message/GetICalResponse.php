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
use Zimbra\Mail\Struct\ICalContent;
use Zimbra\Soap\ResponseInterface;

/**
 * GetICalResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetICalResponse implements ResponseInterface
{
    /**
     * iCalendar content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("ical")
     * @Type("Zimbra\Mail\Struct\ICalContent")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ICalContent $content;

    /**
     * Constructor method for GetICalResponse
     *
     * @param  ICalContent $content
     * @return self
     */
    public function __construct(ICalContent $content)
    {
        $this->setContent($content);
    }

    /**
     * Gets content
     *
     * @return ICalContent
     */
    public function getContent(): ICalContent
    {
        return $this->content;
    }

    /**
     * Sets content
     *
     * @param  ICalContent $content
     * @return self
     */
    public function setContent(ICalContent $content): self
    {
        $this->content = $content;
        return $this;
    }
}
