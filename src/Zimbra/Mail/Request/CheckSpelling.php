<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

/**
 * CheckSpelling request class
 * Check spelling.
 * Suggested words are listed in decreasing order of their match score.
 * The "available" attribute specifies whether the server-side spell checking interface is available or not.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckSpelling extends Base
{
    /**
     * Constructor method for CheckSpelling
     * @param  string $value
     * @param  string $dictionary
     * @param  string $ignore
     * @return self
     */
    public function __construct($value = null, $dictionary = null, $ignore = null)
    {
        parent::__construct($value);
        if(null !== $dictionary)
        {
            $this->setProperty('dictionary', trim($dictionary));
        }
        if(null !== $ignore)
        {
            $this->setProperty('ignore', trim($ignore));
        }
    }

    /**
     * Gets dictionary
     *
     * @return string
     */
    public function getDictionary()
    {
        return $this->getProperty('dictionary');
    }

    /**
     * Sets dictionary
     *
     * @param  string $dictionary
     *     The optional name of the aspell dictionary that will be used to check spelling.
     *     If not specified, the the dictionary will be either zimbraPrefSpellDictionary or the one for the account's locale, in that order.
     * @return self
     */
    public function setDictionary($dictionary)
    {
        return $this->setProperty('dictionary', trim($dictionary));
    }

    /**
     * Gets comma separated ignore words
     *
     * @return string
     */
    public function getIgnoreList()
    {
        return $this->getProperty('ignore');
    }

    /**
     * Sets comma separated ignore words
     *
     * @param  string $ignore
     *     Comma-separated list of words to ignore just for this request.
     *     These words are added to the user's personal dictionary of ignore words stored as zimbraPrefSpellIgnoreWord.
     * @return self
     */
    public function setIgnoreList($ignore)
    {
        return $this->setProperty('ignore', trim($ignore));
    }
}
