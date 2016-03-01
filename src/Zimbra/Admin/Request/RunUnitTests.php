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

use PhpCollection\Sequence;

/**
 * RunUnitTests request class
 * Runs the server-side unit test suite.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RunUnitTests extends Base
{
    /**
     * Test Names
     * @var array
     */
    private $_tests;

    /**
     * Constructor method for RunUnitTests
     * @param  array  $tests
     * @return self
     */
    public function __construct(array $tests = [])
    {
        parent::__construct();
        $this->setTests($tests);

        $this->on('before', function(Base $sender)
        {
            if($sender->getTests()->count())
            {
                $sender->setChild('test', $sender->getTests()->all());
            }
        });
    }

    /**
     * Add a test
     *
     * @param  string $test
     * @return self
     */
    public function addTest($test)
    {
        $test = trim($test);
        if(!empty($test) && !$this->_tests->contains($test))
        {
            $this->_tests->add($test);
        }
        return $this;
    }

    /**
     * Sets test sequence
     *
     * @param  array  $tests
     * @return self
     */
    public function setTests(array $tests)
    {
        $this->_tests = new Sequence();
        foreach ($tests as $test)
        {
            $test = trim($test);
            if(!empty($test) && !$this->_tests->contains($test))
            {
                $this->_tests->add($test);
            }
        }
        return $this;
    }

    /**
     * Gets test sequence
     *
     * @return Sequence
     */
    public function getTests()
    {
        return $this->_tests;
    }
}
