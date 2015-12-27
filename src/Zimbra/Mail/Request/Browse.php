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
class Browse extends Base
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
        $this->setProperty('browseBy', $browseBy);
        if(null !== $regex)
        {
            $this->setProperty('regex', trim($regex));
        }
        if(null !== $maxToReturn)
        {
            $this->setProperty('maxToReturn', (int) $maxToReturn);
        }
    }

    /**
     * Gets browse by setting
     *
     * @return BrowseBy
     */
    public function getBrowseBy()
    {
        return $this->getProperty('browseBy');
    }

    /**
     * Sets browse by setting
     *
     * @param  BrowseBy $browseBy
     *     Browse by setting - domains|attachments|objects
     * @return self
     */
    public function setBrowseBy(BrowseBy $browseBy)
    {
        return $this->setProperty('browseBy', $browseBy);
    }

    /**
     * Gets regex string
     *
     * @return string
     */
    public function getRegex()
    {
        return $this->getProperty('regex');
    }

    /**
     * Sets regex string
     *
     * @param  string $regex
     *     Regex string. Return only those results which match the specified regular expression
     * @return self
     */
    public function setRegex($regex)
    {
        return $this->setProperty('regex', trim($regex));
    }

    /**
     * Gets max entries
     *
     * @return int
     */
    public function getMax()
    {
        return $this->getProperty('maxToReturn');
    }

    /**
     * Sets max entries
     *
     * @param  int $maxToReturn
     *     Return only a maximum number of entries as requested.
     *     If more than {max-entries} results exist, the server will return the first {max-entries}, sorted by frequency
     * @return self
     */
    public function setMax($maxToReturn)
    {
        return $this->setProperty('maxToReturn', (int) $maxToReturn);
    }
}
