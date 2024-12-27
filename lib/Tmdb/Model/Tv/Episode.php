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
use Tmdb\Model\Collection\ResultCollection;
use Tmdb\Model\Collection\Videos;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Image\PosterImage;
use Tmdb\Model\Image\StillImage;

/**
 * Class Episode
 * @package Tmdb\Model\Tv
 */
class Episode extends AbstractModel
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
        'episode_number',
        'name',
        'overview',
        'id',
        'production_code',
        'season_number',
        'still_path',
        'vote_average',
        'vote_count',
        'show_id',
        'runtime',
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
     * @var GenericCollection
     */
    protected $translations;
    /**
     * @var StillImage
     */
    protected $still;
    /**
     * @var Videos
     */
    protected $videos;

    /**
     * @var \DateTime|null
     */
    private $airDate;

    /**
     * @var Changes
     */
    protected $changes;

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
    private $productionCode;

    /**
     * @var string
     */
    private $stillPath;

    /**
     * @var integer
     */
    private $seasonNumber;

    /**
     * @var integer
     */
    private $episodeNumber;

    /**
     * @var float
     */
    private $voteAverage;

    /**
     * @var integer
     */
    private $voteCount;

    /**
     * Only available in episode group
     *
     * @var integer
     */
    private $showId;
    /**
     * @var int
     */
    private $runtime;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->credits = new CreditsCollection();
        $this->externalIds = new ExternalIds();
        $this->images = new Images();
        $this->translations = new GenericCollection();
        $this->videos = new Videos();
        $this->changes = new Changes();
    }

    /**
     * @return ?DateTime
     */
    public function getAirDate()
    {
        return $this->airDate;
    }

    /**
     * @param DateTime|string|null $airDate
     * @return self
     */
    public function setAirDate($airDate = null)
    {
        if (empty($airDate)) {
            $airDate = null;
        } elseif (!$airDate instanceof DateTime) {
            $airDate = new DateTime($airDate);
        }

        $this->airDate = $airDate;

        return $this;
    }

    /**
     * @return int
     */
    public function getEpisodeNumber()
    {
        return $this->episodeNumber;
    }

    /**
     * @param int $episodeNumber
     * @return self
     */
    public function setEpisodeNumber($episodeNumber)
    {
        $this->episodeNumber = (int)$episodeNumber;

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
    public function getProductionCode()
    {
        return $this->productionCode;
    }

    /**
     * @param string $productionCode
     * @return self
     */
    public function setProductionCode($productionCode)
    {
        $this->productionCode = $productionCode;

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
        $this->seasonNumber = (int)$seasonNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getStillPath()
    {
        return $this->stillPath;
    }

    /**
     * @param string $stillPath
     * @return self
     */
    public function setStillPath($stillPath)
    {
        $this->stillPath = $stillPath;

        return $this;
    }

    /**
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * @param float $voteAverage
     * @return self
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = (float)$voteAverage;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * @param int $voteCount
     * @return self
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = (int)$voteCount;

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
     * @return GenericCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param GenericCollection $translations
     * @return self
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @param StillImage $still
     * @return self
     */
    public function setStillImage($still)
    {
        $this->still = $still;

        return $this;
    }

    /**
     * @return StillImage
     */
    public function getStillImage()
    {
        return $this->still;
    }

    /**
     * @return Videos
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Videos|ResultCollection $videos
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
     * @return int
     */
    public function getShowId(): int
    {
        return $this->showId;
    }

    /**
     * @param int $showId
     * @return Episode
     */
    public function setShowId(int $showId): Episode
    {
        $this->showId = $showId;

        return $this;
    }

    /**
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * @param int $runtime
     */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }
}
