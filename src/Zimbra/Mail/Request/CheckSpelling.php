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

use Zimbra\Soap\Request;

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
class CheckSpelling extends Request
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
            $this->property('dictionary', trim($dictionary));
        }
        if(null !== $ignore)
        {
            $this->property('ignore', trim($ignore));
        }
    }

    /**
     * Get or set dictionary
     * The optional name of the aspell dictionary that will be used to check spelling.
     * If not specified, the the dictionary will be either zimbraPrefSpellDictionary or the one for the account's locale, in that order.
     *
     * @param  string $dictionary
     * @return string|self
     */
    public function dictionary($dictionary = null)
    {
        if(null === $dictionary)
        {
            return $this->property('dictionary');
        }
        return $this->property('dictionary', trim($dictionary));
    }

    /**
     * Get or set ignore
     * Comma-separated list of words to ignore just for this request.
     * These words are added to the user's personal dictionary of ignore words stored as zimbraPrefSpellIgnoreWord.
     *
     * @param  string $ignore
     * @return string|self
     */
    public function ignore($ignore = null)
    {
        if(null === $ignore)
        {
            return $this->property('ignore');
        }
        return $this->property('ignore', trim($ignore));
    }
}
