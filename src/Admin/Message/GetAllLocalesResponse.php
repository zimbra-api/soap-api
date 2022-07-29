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
use Zimbra\Admin\Struct\LocaleInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAllLocalesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllLocalesResponse implements SoapResponseInterface
{
    /**
     * Information for system locales
     * 
     * @Accessor(getter="getLocales", setter="setLocales")
     * @Type("array<Zimbra\Admin\Struct\LocaleInfo>")
     * @XmlList(inline=true, entry="locale", namespace="urn:zimbraAdmin")
     */
    private $locales = [];

    /**
     * Constructor method for GetAllLocalesResponse
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
     * Set locales
     *
     * @param  array $locales
     * @return self
     */
    public function setLocales(array $locales): self
    {
        $this->locales = array_filter($locales, static fn ($locale) => $locale instanceof LocaleInfo);
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
