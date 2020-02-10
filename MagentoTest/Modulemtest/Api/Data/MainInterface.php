<?php

namespace MagentoTest\Modulemtest\Api\Data;

interface MainInterface
{
    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const CONTENT = 'content';
    const SEASON = 'season';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getSeason();
}
