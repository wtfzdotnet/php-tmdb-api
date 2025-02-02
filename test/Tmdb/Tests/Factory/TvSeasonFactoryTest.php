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

use Tmdb\Factory\TvSeasonFactory;
use Tmdb\Model\Tv\Season;

class TvSeasonFactoryTest extends TestCase
{
    /**
     * @var Season
     */
    private $season;

    public function setUp(): void
    {
        /**
         * @var TvSeasonFactory $factory
         */
        $factory = $this->getFactory();
        $data = $this->loadByFile('tv/season/all.json');

        /**
         * @var Season $this->season
         */
        $this->season = $factory->create($data);
    }

    /**
     * @test
     */
    public function shouldConstructTvSeason()
    {
        $this->assertInstanceOf('Tmdb\Model\Tv\Season', $this->season);

        $this->assertInstanceOf('\DateTime', $this->season->getAirDate());

        $this->assertInstanceOf('Tmdb\Model\Collection\CreditsCollection', $this->season->getCredits());
        $this->assertInstanceOf('Tmdb\Model\Common\ExternalIds', $this->season->getExternalIds());
        $this->assertInstanceOf('Tmdb\Model\Collection\Images', $this->season->getImages());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->season->getEpisodes());
        $this->assertInstanceOf('Tmdb\Model\Image\PosterImage', $this->season->getPosterImage());
        $this->assertInstanceOf('Tmdb\Model\Common\GenericCollection', $this->season->getTranslations());
    }

    /**
     * @test
     */
    public function shouldBeAbleToSetFactories()
    {
        /**
         * @var TvSeasonFactory $factory
         */
        $factory = $this->getFactory();

        $class = new \stdClass();

        $factory->setCastFactory($class);
        $factory->setCrewFactory($class);
        $factory->setImageFactory($class);
        $factory->setTvEpisodeFactory($class);

        $this->assertInstanceOf('stdClass', $factory->getCastFactory());
        $this->assertInstanceOf('stdClass', $factory->getCrewFactory());
        $this->assertInstanceOf('stdClass', $factory->getImageFactory());
        $this->assertInstanceOf('stdClass', $factory->getTvEpisodeFactory());
    }

    /**
     * @test
     */
    public function shouldBeFunctional()
    {
        $this->assertEquals(new \DateTime('2009-03-08'), $this->season->getAirDate());
        $this->assertEquals('Season 2', $this->season->getName());
        $this->assertEquals('The second season of the American television drama series Breaking Bad premiered on March 8, 2009 and concluded on May 31, 2009. It consisted of 13 episodes, each running approximately 47 minutes in length. AMC broadcast the second season on Sundays at 10:00 pm in the United States. The complete second season was released on Region 1 DVD and Region A Blu-ray on March 16, 2010.', $this->season->getOverview());
        $this->assertEquals(3573, $this->season->getId());
        $this->assertEquals('/rCdISteF1GPvPsy0a5L0LDffjtP.jpg', $this->season->getPosterPath());
        $this->assertEquals(2, $this->season->getSeasonNumber());
        $this->assertEquals("Sein Ruf eilt dem zum Meth-Dealer gewordenen Lehrer Walter voraus – das erregt die Aufmerksamkeit rivalisierender Kartelle und gefährdet seinen Schwager, einen Drogencop.",
            $this->season->getTranslations()->filterLanguage('de')->getIterator()->current()->getData()['overview']
        );
}

    protected function getFactoryClass()
    {
        return 'Tmdb\Factory\TvSeasonFactory';
    }
}
