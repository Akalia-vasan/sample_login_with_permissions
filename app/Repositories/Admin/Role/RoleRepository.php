<?php

namespace App\Repositories\Admin\Role;

use App\Exceptions\GeneralException;
use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;
use DB;

class RoleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Role::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'roles.id',
                'roles.name',
                'roles.created_at',
                'roles.updated_at',
            ]);
    }
}