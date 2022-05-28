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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\LocaleInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAvailableLocalesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAvailableLocalesResponse implements ResponseInterface
{
    /**
     * Information about locales
     * 
     * @Accessor(getter="getLocales", setter="setLocales")
     * @SerializedName("locale")
     * @Type("array<Zimbra\Account\Struct\LocaleInfo>")
     * @XmlList(inline = true, entry = "locale")
     */
    private $locales = [];

    /**
     * Constructor method for GetAvailableLocalesResponse
     *
     * @param array $locales
     * @return self
     */
    public function __construct(array $locales = [])
    {
        $this->setLocales($locales);
    }

    /**
     * Add a locale
     *
     * @param  LocaleInfo $locale
     * @return self
     */
    public function addLocale(LocaleInfo $locale): self
    {
        $this->locales[] = $locale;
        return $this;
    }

    /**
     * Sets locales
     *
     * @param  array $locales
     * @return self
     */
    public function setLocales(array $locales): self
    {
        $this->locales = [];
        foreach ($locales as $locale) {
            if ($locale instanceof LocaleInfo) {
                $this->locales[] = $locale;
            }
        }
        return $this;
    }

    /**
     * Gets locales
     *
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }
}
