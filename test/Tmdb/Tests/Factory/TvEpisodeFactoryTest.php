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

namespace Tmdb\Tests\Factory;

use Tmdb\Factory\TvEpisodeFactory;
use Tmdb\Model\Tv\Episode;

class TvEpisodeFactoryTest extends TestCase
{
    /**
     * @var Episode
     */
    private $episode;

    public function setUp(): void
    {
        /**
         * @var TvEpisodeFactory $factory
         */
        $factory = $this->getFactory();
        $data = $this->loadByFile('tv/season/episode/all.json');

        /**
         * @var Episode $episode
         */
        $this->episode = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructTvEpisode()
    {
        $this->assertInstanceOf('Tmdb\Model\Tv\Episode', $this->episode);

        $this->assertInstanceOf('\DateTime', $this->episode->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection', $this->episode->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Common\ExternalIds', $this->episode->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->episode->getImages());
        $this->assertInstanceOf('Tmdb\Model\Image\StillImage', $this->episode->getStillImage());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var TvEpisodeFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setImageFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals(new \DateTime('2009-03-08'), $this->episode->getAirDate());
        $this->assertEquals(1, $this->episode->getEpisodeNumber());
        $this->assertEquals('Seven Thirty-Seven', $this->episode->getName());
        $this->assertEquals('Walt and Jesse are vividly reminded of Tuco’s volatile nature, and try to figure a way out of their business partnership. Hank attempts to mend fences between the estranged Marie and Skyler.', $this->episode->getOverview());
        $this->assertEquals(972873, $this->episode->getId());
        $this->assertEquals("", $this->episode->getProductionCode());
        $this->assertEquals(2, $this->episode->getSeasonNumber());
        $this->assertEquals('/7vVujNqjP23MtPqUTBNITIW3DDA.jpg', $this->episode->getStillPath());
        $this->assertEquals(8.272, $this->episode->getVoteAverage());
        $this->assertEquals(125, $this->episode->getVoteCount());
        $this->assertEquals(48, $this->episode->getRuntime());
    }

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvEpisodeFactory';
    }
}
