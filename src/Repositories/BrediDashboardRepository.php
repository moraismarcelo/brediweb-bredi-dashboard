<?php
namespace Bredi\BrediDashboard\Repository;

use Bredi\BrediDashboard\Repository\BaseRepository;

class BrediDashboardRepository extends BaseRepository
{
    protected $modelClass = \Bredi\BrediDashboard\Models\Config::class;

    public function getConfig()
    {
        return $this->modelClass::first();

    }

}