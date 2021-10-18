<?php
namespace Brediweb\BrediDashboard\Repository;

use Brediweb\BrediDashboard\Repository\BaseRepository;

class BrediDashboardRepository extends BaseRepository
{
    protected $modelClass = \Brediweb\BrediDashboard\Models\Config::class;

    public function getConfig()
    {
        return $this->modelClass::first();

    }

}