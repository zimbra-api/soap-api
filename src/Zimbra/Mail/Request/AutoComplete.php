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

use Zimbra\Enum\GalSearchType;

/**
 * AutoComplete request class
 * Auto complete
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoComplete extends Base
{
    /**
     * Constructor method for AutoComplete
     * @param  string $name
     * @param  GalSearchType $t
     * @param  bool   $needExp
     * @param  string $folders
     * @param  bool   $includeGal
     * @return self
     */
    public function __construct(
        $name,
        GalSearchType $t = null,
        $needExp = null,
        $folders = null,
        $includeGal = null
    )
    {
        parent::__construct();
        $this->property('name', trim($name));
        if($t instanceof GalSearchType)
        {
            $this->property('t', $t);
        }
        if(null !== $needExp)
        {
            $this->property('needExp', (bool) $needExp);
        }
        if(null !== $folders)
        {
            $this->property('folders', trim($folders));
        }
        if(null !== $includeGal)
        {
            $this->property('includeGal', (bool) $includeGal);
        }
    }

    /**
     * Get or set name
     * The name to test for autocompletion
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Get or set t
     * GAL Search type - default value is "account"
     *
     * @param  GalSearchType $t
     * @return GalSearchType|self
     */
    public function t(GalSearchType $t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', $t);
    }

    /**
     * Get or set needExp
     * Set if the "exp" flag is needed in the response for group entries. Default is unset.
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->property('needExp');
        }
        return $this->property('needExp', (bool) $needExp);
    }

    /**
     * Get or set folders
     * Comma separated list of folder IDs
     *
     * @param  string $folders
     * @return string|self
     */
    public function folders($folders = null)
    {
        if(null === $folders)
        {
            return $this->property('folders');
        }
        return $this->property('folders', trim($folders));
    }

    /**
     * Get or set includeGal
     * Flag whether to include Global Address Book (GAL)
     *
     * @param  bool $includeGal
     * @return bool|self
     */
    public function includeGal($includeGal = null)
    {
        if(null === $includeGal)
        {
            return $this->property('includeGal');
        }
        return $this->property('includeGal', (bool) $includeGal);
    }
}
