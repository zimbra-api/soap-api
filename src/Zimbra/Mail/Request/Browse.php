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

use Zimbra\Enum\BrowseBy;
use Zimbra\Soap\Request;

/**
 * Browse request class
 * Browse
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Browse extends Request
{
    /**
     * Constructor method for BounceMsg
     * @param  BrowseBy $browseBy
     * @param  string $regex
     * @param  int $maxToReturn
     * @return self
     */
    public function __construct(BrowseBy $browseBy, $regex = null, $maxToReturn = null)
    {
        parent::__construct();
        $this->property('browseBy', $browseBy);
        if(null !== $regex)
        {
            $this->property('regex', trim($regex));
        }
        if(null !== $maxToReturn)
        {
            $this->property('maxToReturn', (int) $maxToReturn);
        }
    }

    /**
     * Get or set browseBy
     * Browse by setting - domains|attachments|objects
     *
     * @param  BrowseBy $browseBy
     * @return BrowseBy|self
     */
    public function browseBy(BrowseBy $browseBy = null)
    {
        if(null === $browseBy)
        {
            return $this->property('browseBy');
        }
        return $this->property('browseBy', $browseBy);
    }

    /**
     * Get or set regex
     * Regex string. Return only those results which match the specified regular expression
     *
     * @param  string $regex
     * @return string|self
     */
    public function regex($regex = null)
    {
        if(null === $regex)
        {
            return $this->property('regex');
        }
        return $this->property('regex', trim($regex));
    }

    /**
     * Get or set maxToReturn
     * Return only a maximum number of entries as requested.
     * If more than {max-entries} results exist, the server will return the first {max-entries}, sorted by frequency
     *
     * @param  int $maxToReturn
     * @return int|self
     */
    public function maxToReturn($maxToReturn = null)
    {
        if(null === $maxToReturn)
        {
            return $this->property('maxToReturn');
        }
        return $this->property('maxToReturn', (int) $maxToReturn);
    }
}
