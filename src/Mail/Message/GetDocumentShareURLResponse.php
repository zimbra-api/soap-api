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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlValue};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDocumentShareURLResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDocumentShareURLResponse extends SoapResponse
{
    /**
     * url
     *
     * @Accessor(getter="getUrl", setter="setUrl")
     * @Type("string")
     * @XmlValue
     *
     * @var string
     */
    #[Accessor(getter: "getUrl", setter: "setUrl")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $url;

    /**
     * Constructor
     *
     * @param  string $url
     * @return self
     */
    public function __construct(string $url = "")
    {
        $this->setUrl($url);
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
}
