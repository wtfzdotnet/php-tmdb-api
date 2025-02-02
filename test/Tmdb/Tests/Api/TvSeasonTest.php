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

namespace Tmdb\Tests\Api;

class TvSeasonTest extends TestCase
{
    public const TV_ID = 3572;
    public const SEASON_ID = 1;

    /**
     * @test
     */
    public function shouldGetSeason()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getSeason(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID);
    }

    /**
     * @test
     */
    public function shouldGetSeasonCredits()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getCredits(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/credits');
    }

    /**
     * @test
     */
    public function shouldGetSeasonExternalIds()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getExternalIds(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod(
            '/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/external_ids'
        );
    }

    /**
     * @test
     */
    public function shouldGetSeasonImages()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getImages(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/images');
    }

    /**
     * @test
     */
    public function shouldGetSeasonVideos()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getVideos(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/videos');
    }

    /**
     * @test
     */
    public function shouldGetSeasonChanges()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getChanges(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/changes');
    }

    /**
     * @test
     */
    public function shouldGetSeasonTranslations()
    {
        $api = $this->getApiWithMockedHttpAdapter();

        $api->getTranslations(self::TV_ID, self::SEASON_ID);
        $this->assertLastRequestIsWithPathAndMethod('/3/tv/' . self::TV_ID . '/season/' . self::SEASON_ID . '/translations');
    }

    protected function getApiClass()
    {
        return 'Tmdb\Api\TvSeason';
    }
}
