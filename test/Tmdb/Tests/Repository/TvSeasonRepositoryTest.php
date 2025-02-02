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

namespace Tmdb\Tests\Repository;

use Tmdb\Exception\RuntimeException;
use Tmdb\Model\Tv;

class TvSeasonRepositoryTest extends TestCase
{
    public const TV_ID     = 3572;
    public const SEASON_NUMBER = 1;

    /**
     * @test
     */
    public function shouldLoadTvSeason()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $repository->load(self::TV_ID, self::SEASON_NUMBER);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER);
        $this->assertRequestHasQueryParameters(['append_to_response' => 'credits,external_ids,images,changes,videos']);
    }

    /**
     * @test
     */
    public function shouldBeAbleToLoadTvSeasonWithTvAndSeason()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->load($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER);
        $this->assertRequestHasQueryParameters(['append_to_response' => 'credits,external_ids,images,changes,videos']);
    }

    /**
     * @test
     */
    public function shouldGetCredits()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->getCredits($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/credits');
    }

    /**
     * @test
     */
    public function shouldGetTranslations()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->getTranslations($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/translations');
    }

    /**
     * @test
     */
    public function shouldGetExternalIds()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->getExternalIds($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/external_ids');
    }

    /**
     * @test
     */
    public function shouldGetImages()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->getImages($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/images');
    }

    /**
     * @test
     */
    public function shouldGetVideos()
    {
        $repository = $this->getRepositoryWithMockedHttpAdapter();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $season = new Tv\Season();
        $season->setSeasonNumber(self::SEASON_NUMBER);

        $repository->getVideos($tv, $season);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_NUMBER . '/videos');
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMet()
    {
        $this->expectException(RuntimeException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();

        $tv = new Tv();
        $tv->setId(self::TV_ID);

        $repository->load($tv, null);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenConditionsNotMetAll()
    {
        $this->expectException(RuntimeException::class);
        $repository = $this->getRepositoryWithMockedHttpClient();
        $repository->load(null, null);
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvSeason';
    }

    protected function getRepositoryClass()
    {
        return 'Tmdb\Repository\TvSeasonRepository';
    }
}
