<?php
namespace Brediweb\BrediDashboard\Repositories;

use Brediweb\BrediDashboard\Repositories\BaseRepository;

class BrediDashboardRepository extends BaseRepository
{
    protected $modelClass = \Brediweb\BrediDashboard\Models\Config::class;

    public function getConfig()
    {
        return $this->modelClass::first();

    }

}