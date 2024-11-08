<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\Model\Common;

use Tmdb\Model\AbstractModel;
use Tmdb\Model\Filter\LanguageFilter;

/**
 * Class SpokenLanguage
 * @package Tmdb\Model\Common
 */
class SpokenLanguage extends AbstractModel implements LanguageFilter
{
    public static $properties = [
        'iso_639_1',
        'name',
        'english_name',
    ];
    private $iso6391;
    private $name;
    private $englishName;

    /**
     * @return string
     */
    public function getIso6391()
    {
        return $this->iso6391;
    }

    /**
     * @param string $iso6391
     * @return self
     */
    public function setIso6391($iso6391)
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnglishName()
    {
        return $this->englishName;
    }

    /**
     * @param string $englishName
     * @return self
     */
    public function setEnglishName($englishName)
    {
        $this->englishName = $englishName;

        return $this;
    }
}
