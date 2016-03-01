<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

/**
 * UploadProxyCA request class
 * Upload proxy CA.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadProxyCA extends Base
{
    /**
     * Constructor method for UploadProxyCA
     * @param string $certAid Certificate attach ID
     * @param string $certFilename Certificate name
     * @return self
     */
    public function __construct($certAid, $certFilename)
    {
        parent::__construct();
        $this->setProperty('cert.aid', trim($certAid));
        $this->setProperty('cert.filename', trim($certFilename));
    }

    /**
     * Gets cert aid
     *
     * @return string
     */
    public function getCertAid()
    {
        return $this->getProperty('cert.aid');
    }

    /**
     * Sets cert aid
     *
     * @param  string $certAid
     * @return self
     */
    public function setCertAid($certAid)
    {
        return $this->setProperty('cert.aid', trim($certAid));
    }

    /**
     * Gets cert filename
     *
     * @return string
     */
    public function getCertFilename()
    {
        return $this->getProperty('cert.filename');
    }

    /**
     * Sets cert filename
     *
     * @param  string $certFilename
     * @return self
     */
    public function setCertFilename($certFilename)
    {
        return $this->setProperty('cert.filename', trim($certFilename));
    }
}
