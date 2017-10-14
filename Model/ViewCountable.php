<?php

namespace tchoulom\ViewCounterBundle\Model;

/**
 * Interface ViewCountable
 *
 * @package tchoulom\ViewCounterBundle\Model
 */
interface ViewCountable
{
    /**
     * Get $views
     *
     * @return integer
     */
    public function getViews();

    /**
     * Set $views
     *
     * @param integer $views
     *
     * @return $this
     */
    public function setViews($views);
}