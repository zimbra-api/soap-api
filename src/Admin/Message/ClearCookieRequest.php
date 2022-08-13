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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ClearCookie request class
 * Clear cookie
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ClearCookieRequest extends SoapRequest
{
    /**
     * Specifies cookies to clean
     * 
     * @Accessor(getter="getCookies", setter="setCookies")
     * @Type("array<Zimbra\Admin\Struct\CookieSpec>")
     * @XmlList(inline=true, entry="cookie", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCookies', setter: 'setCookies')]
    #[Type(name: 'array<Zimbra\Admin\Struct\CookieSpec>')]
    #[XmlList(inline: true, entry: 'cookie', namespace: 'urn:zimbraAdmin')]
    private $cookies = [];

    /**
     * Constructor
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
     * Set cookies
     *
     * @param array $cookies
     * @return self
     */
    public function setCookies(array $cookies): self
    {
        $this->cookies = array_filter($cookies, static fn ($cookie) => $cookie instanceof CookieSpec);
        return $this;
    }

    /**
     * Get cookies
     *
     * @return array
     */
    public function getCookies(): ?array
    {
        return $this->cookies;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ClearCookieEnvelope(
            new ClearCookieBody($this)
        );
    }
}
