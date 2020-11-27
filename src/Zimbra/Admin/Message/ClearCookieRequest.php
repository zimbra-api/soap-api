<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Soap\Request;

/**
 * ClearCookie request class
 * Clear cookie
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ClearCookieRequest")
 */
class ClearCookieRequest extends Request
{
    /**
     * Specifies cookies to clean
     * @Accessor(getter="getCookies", setter="setCookies")
     * @SerializedName("cookie")
     * @Type("array<Zimbra\Admin\Struct\CookieSpec>")
     * @XmlList(inline = true, entry = "cookie")
     */
    private $cookies;

    /**
     * Constructor method for ClearCookieRequest
     * 
     * @param array $cookies
     * @return self
     */
    public function __construct(array $cookies = [])
    {
        $this->setCookies($cookies);
    }

    /**
     * Add a cookie
     *
     * @param  CookieSpec $cookie
     * @return self
     */
    public function addCookie(CookieSpec $cookie): self
    {
        $this->cookies[] = $cookie;
        return $this;
    }

    /**
     * Sets cookies
     *
     * @param array $cookies
     * @return self
     */
    public function setCookies(array $cookies): self
    {
        $this->cookies = [];
        foreach ($cookies as $cookie) {
            if ($cookie instanceof CookieSpec) {
                $this->cookies[] = $cookie;
            }
        }
        return $this;
    }

    /**
     * Gets cookies
     *
     * @return array
     */
    public function getCookies(): ?array
    {
        return $this->cookies;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ClearCookieEnvelope)) {
            $this->envelope = new ClearCookieEnvelope(
                new ClearCookieBody($this)
            );
        }
    }
}
