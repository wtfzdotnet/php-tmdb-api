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

namespace Tmdb\Model\Tv;

use DateTime;
use Tmdb\Model\AbstractModel;
use Tmdb\Model\Collection\Changes;
use Tmdb\Model\Collection\CreditsCollection;
use Tmdb\Model\Collection\Images;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Translation;
use Tmdb\Model\Image\PosterImage;

/**
 * Class Season
 * @package Tmdb\Model\Tv
 */
class Season extends AbstractModel
{
    /**
     * Properties that are available in the API
     *
     * These properties are hydrated by the ObjectHydrator, all the other properties are handled by the factory.
     *
     * @var array
     */
    public static $properties = [
        'air_date',
        'name',
        'overview',
        'id',
        'poster_path',
        'season_number'
    ];
    /**
     * Credits
     *
     * @var CreditsCollection
     */
    protected $credits;
    /**
     * External Ids
     *
     * @var ExternalIds
     */
    protected $externalIds;
    /**
     * Images
     *
     * @var Images
     */
    protected $images;
    /**
     * @var PosterImage
     */
    protected $poster;
    /**
     * @var Videos
     */
    protected $videos;
    /**
     * @var Changes
     */
    protected $changes;
    /**
     * @var GenericCollection|Translation[]
     */
    protected $translations;
    /**
     * @var DateTime
     */
    private $airDate;
    /**
     * @var GenericCollection|Episode[]
     */
    private $episodes;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $overview;
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $posterPath;
    /**
     * @var integer
     */
    private $seasonNumber;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->episodes = new GenericCollection();
        $this->videos = new Videos();
        $this->changes = new Changes();
        $this->translations = new GenericCollection();
    }

    /**
     * @return DateTime
     */
    public function getAirDate()
    {
        return $this->airDate;
    }

    /**
     * @param string $airDate
     * @return self
     */
    public function setAirDate($airDate)
    {
        $this->airDate = new DateTime($airDate);

        return $this;
    }

    /**
     * @return GenericCollection|Episode[]
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * @param GenericCollection $episodes
     * @return self
     */
    public function setEpisodes($episodes)
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int)$id;

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
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return self
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * @param string $posterPath
     * @return self
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * @return int
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * @param int $seasonNumber
     * @return self
     */
    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    /**
     * @return CreditsCollection
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param CreditsCollection $credits
     * @return self
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * @return ExternalIds
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param ExternalIds $externalIds
     * @return self
     */
    public function setExternalIds($externalIds)
    {
        $this->externalIds = $externalIds;

        return $this;
    }

    /**
     * @return Images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Images $images
     * @return self
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param PosterImage $poster
     * @return self
     */
    public function setPosterImage($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return PosterImage
     */
    public function getPosterImage()
    {
        return $this->poster;
    }

    /**
     * @return Videos
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Videos $videos
     * @return self
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;

        return $this;
    }

    /**
     * @return Changes
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * @param Changes $changes
     * @return self
     */
    public function setChanges($changes)
    {
        $this->changes = $changes;

        return $this;
    }

    /**
     * @return GenericCollection
     */
    public function getTranslations(): GenericCollection
    {
        return $this->translations;
    }

    /**
     * @param GenericCollection $changes
     * @return self
     */
    public function setTranslations($changes)
    {
        $this->translations = $changes;

        return $this;
    }
}
