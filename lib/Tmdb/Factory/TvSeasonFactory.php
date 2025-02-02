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

namespace Tmdb\Factory;

use Tmdb\Factory\Common\ChangeFactory;
use Tmdb\Factory\Common\VideoFactory;
use Tmdb\Factory\People\CastFactory;
use Tmdb\Factory\People\CrewFactory;
use Tmdb\HttpClient\HttpClient;
use Tmdb\Model\Common\ExternalIds;
use Tmdb\Model\Common\GenericCollection;
use Tmdb\Model\Common\Translation;
use Tmdb\Model\Person\CastMember;
use Tmdb\Model\Person\CrewMember;
use Tmdb\Model\Tv\Season;

/**
 * Class TvSeasonFactory
 * @extends AbstractFactory<Season>
 * @package Tmdb\Factory
 */
class TvSeasonFactory extends AbstractFactory
{
    /**
     * @var People\CastFactory
     */
    private $castFactory;

    /**
     * @var People\CrewFactory
     */
    private $crewFactory;

    /**
     * @var ImageFactory
     */
    private $imageFactory;

    /**
     * @var TvEpisodeFactory
     */
    private $tvEpisodeFactory;

    /**
     * @var Common\VideoFactory
     */
    private $videoFactory;

    /**
     * @var ChangeFactory
     */
    private $changesFactory;

    /**
     * Constructor
     *
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->castFactory = new CastFactory($httpClient);
        $this->crewFactory = new CrewFactory($httpClient);
        $this->imageFactory = new ImageFactory($httpClient);
        $this->tvEpisodeFactory = new TvEpisodeFactory($httpClient);
        $this->videoFactory = new VideoFactory($httpClient);
        $this->changesFactory = new ChangeFactory($httpClient);

        parent::__construct($httpClient);
    }

    /**
     * {@inheritdoc}
     */
    public function createCollection(array $data = [])
    {
        /** @var GenericCollection<Season> */
        $collection = new GenericCollection();

        foreach ($data as $item) {
            $collection->add(null, $this->create($item));
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     *
     * @return Season|null
     */
    public function create(array $data = []): ?Season
    {
        if (!$data) {
            return null;
        }

        $tvSeason = new Season();

        if (array_key_exists('credits', $data)) {
            if (array_key_exists('cast', $data['credits']) && $data['credits']['cast'] !== null) {
                $tvSeason->getCredits()->setCast(
                    $this->getCastFactory()->createCollection(
                        $data['credits']['cast'],
                        new CastMember()
                    )
                );
            }

            if (array_key_exists('crew', $data['credits']) && $data['credits']['crew'] !== null) {
                $tvSeason->getCredits()->setCrew(
                    $this->getCrewFactory()->createCollection(
                        $data['credits']['crew'],
                        new CrewMember()
                    )
                );
            }
        }

        /** External ids */
        if (array_key_exists('external_ids', $data) && $data['external_ids'] !== null) {
            $tvSeason->setExternalIds(
                $this->hydrate(new ExternalIds(), $data['external_ids'])
            );
        }

        /** Images */
        if (array_key_exists('images', $data) && $data['images'] !== null) {
            $tvSeason->setImages($this->getImageFactory()->createCollectionFromTvSeason($data['images']));
        }

        if (array_key_exists('poster_path', $data)) {
            $tvSeason->setPosterImage($this->getImageFactory()->createFromPath($data['poster_path'], 'poster_path'));
        }

        /** Episodes */
        if (array_key_exists('episodes', $data) && $data['episodes'] !== null) {
            $tvSeason->setEpisodes($this->getTvEpisodeFactory()->createCollection($data['episodes']));
        }

        if (array_key_exists('videos', $data) && $data['videos'] !== null) {
            $tvSeason->setVideos($this->getVideoFactory()->createCollection($data['videos']));
        }

        if (array_key_exists('changes', $data) && $data['changes'] !== null) {
            $tvSeason->setChanges($this->getChangesFactory()->createCollection($data['changes']));
        }

        if (array_key_exists('translations', $data) && $data['translations'] !== null) {
            $tvSeason->setTranslations(
                $this->createGenericCollection(
                    $data['translations']['translations'] ?? [],
                    new Translation()
                )
            );
        }

        return $this->hydrate($tvSeason, $data);
    }

    /**
     * @return CastFactory
     */
    public function getCastFactory()
    {
        return $this->castFactory;
    }

    /**
     * @param CastFactory $castFactory
     * @return self
     */
    public function setCastFactory($castFactory)
    {
        $this->castFactory = $castFactory;

        return $this;
    }

    /**
     * @return CrewFactory
     */
    public function getCrewFactory()
    {
        return $this->crewFactory;
    }

    /**
     * @param CrewFactory $crewFactory
     * @return self
     */
    public function setCrewFactory($crewFactory)
    {
        $this->crewFactory = $crewFactory;

        return $this;
    }

    /**
     * @return ImageFactory
     */
    public function getImageFactory()
    {
        return $this->imageFactory;
    }

    /**
     * @param ImageFactory $imageFactory
     * @return self
     */
    public function setImageFactory($imageFactory)
    {
        $this->imageFactory = $imageFactory;

        return $this;
    }

    /**
     * @return TvEpisodeFactory
     */
    public function getTvEpisodeFactory()
    {
        return $this->tvEpisodeFactory;
    }

    /**
     * @param TvEpisodeFactory $tvEpisodeFactory
     * @return self
     */
    public function setTvEpisodeFactory($tvEpisodeFactory)
    {
        $this->tvEpisodeFactory = $tvEpisodeFactory;

        return $this;
    }

    /**
     * @return VideoFactory
     */
    public function getVideoFactory()
    {
        return $this->videoFactory;
    }

    /**
     * @param VideoFactory $videoFactory
     * @return self
     */
    public function setVideoFactory($videoFactory)
    {
        $this->videoFactory = $videoFactory;

        return $this;
    }

    /**
     * @return ChangeFactory
     */
    public function getChangesFactory()
    {
        return $this->changesFactory;
    }

    /**
     * @param ChangeFactory $changesFactory
     * @return self
     */
    public function setChangesFactory($changesFactory)
    {
        $this->changesFactory = $changesFactory;

        return $this;
    }
}
