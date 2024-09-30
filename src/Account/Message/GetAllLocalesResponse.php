<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\LocaleInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllLocalesResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllLocalesResponse extends SoapResponse
{
    /**
     * Information about locales
     *
     * @Accessor(getter="getLocales", setter="setLocales")
     * @Type("array<Zimbra\Account\Struct\LocaleInfo>")
     * @XmlList(inline=true, entry="locale", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getLocales", setter: "setLocales")]
    #[Type("array<Zimbra\Account\Struct\LocaleInfo>")]
    #[XmlList(inline: true, entry: "locale", namespace: "urn:zimbraAccount")]
    private $locales = [];

    /**
     * Constructor
     *
     * @param array $locales
     * @return self
     */
    public function __construct(array $locales = [])
    {
        $this->setLocales($locales);
    }

    /**
     * Set locales
     *
     * @param  array $locales
     * @return self
     */
    public function setLocales(array $locales): self
    {
        $this->locales = array_filter(
            $locales,
            static fn($locale) => $locale instanceof LocaleInfo
        );
        return $this;
    }

    /**
     * Get locales
     *
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }
}
