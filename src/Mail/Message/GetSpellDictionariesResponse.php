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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetSpellDictionariesResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetSpellDictionariesResponse implements SoapResponseInterface
{
    /**
     * Dictionaries
     * 
     * @Accessor(getter="getDictionaries", setter="setDictionaries")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="dictionary", namespace="urn:zimbraMail")
     */
    private $dictionaries = [];

    /**
     * Constructor method for GetSpellDictionariesResponse
     *
     * @param  array $dictionaries
     * @return self
     */
    public function __construct(array $dictionaries = [])
    {
        $this->setDictionaries($dictionaries);
    }

    /**
     * Add dictionary
     *
     * @param  string $dictionary
     * @return self
     */
    public function addDictionary(string $dictionary): self
    {
        $dictionary = trim($dictionary);
        if (!empty($dictionary) && !in_array($dictionary, $this->dictionaries)) {
            $this->dictionaries[] = $dictionary;
        }
        return $this;
    }

    /**
     * Set dictionaries
     *
     * @param  array $dictionaries
     * @return self
     */
    public function setDictionaries(array $dictionaries): self
    {
        $this->dictionaries = array_unique($dictionaries);
        return $this;
    }

    /**
     * Get dictionaries
     *
     * @return array
     */
    public function getDictionaries(): array
    {
        return $this->dictionaries;
    }
}
