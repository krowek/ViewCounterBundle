<?php

/**
 * This file is part of the TchoulomViewCounterBundle package.
 *
 * @package    TchoulomViewCounterBundle
 * @author     Original Author <tchoulomernest@yahoo.fr>
 *
 * (c) Ernest TCHOULOM <https://www.tchoulom.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tchoulom\ViewCounterBundle\Geolocation;

use Tchoulom\ViewCounterBundle\Adapter\Geolocator\GeolocatorAdapterInterface;
use Tchoulom\ViewCounterBundle\Statistics\ViewDateTrait;
use Tchoulom\ViewCounterBundle\Util\Date;

/**
 * Class Region
 */
class Region
{
    /**
     * The region name.
     *
     * @var string
     */
    protected $name;

    /**
     * The total of views.
     *
     * @var int
     */
    protected $total = 0;

    /**
     * The region cities.
     *
     * @var City[]
     */
    protected $cities = [];

    use ViewDateTrait;

    /**
     * Gets the region name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the region name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the total of views.
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Sets the total of views.
     *
     * @param int $total
     *
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Gets the cities.
     *
     * @return City[]
     */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
     * Builds the region.
     *
     * @param GeolocatorAdapterInterface $geolocatorAdapter
     *
     * @return self
     */
    public function build(GeolocatorAdapterInterface $geolocatorAdapter): self
    {
        $this->total++;
        $this->buildViewDate();
        $this->name = $geolocatorAdapter->getRegion();
        $cityName = $geolocatorAdapter->getCity();

        if (isset($this->cities[$cityName])) {
            $city = $this->cities[$cityName];
        } else {
            $city = new City();
        }

        $this->cities[$cityName] = $city->build($geolocatorAdapter);

        return $this;
    }
}
