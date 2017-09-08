<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\PrivilegesManager;
use Spatie\Permission\Models\Permission;

class GeneratePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all permission by route\'s information.';


    private $privilegesManager;

    public function __construct(PrivilegesManager $privilegesManager)
    {
        parent::__construct();

        $this->privilegesManager = $privilegesManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = $this->privilegesManager->getAllRouteNames();

        array_map(function($route) {
            $res = Permission::updateOrCreate([
                'name' => $route['name'],
                'guard_name' => $route['guard_name']
            ], [
                'remark' => $route['remark']
            ]);

            if ($res) {
                $this->info($route['remark'] . '插入或更新成功!');
            } else {
                $this->error($route['remark'] . '插入或更新失败!');
            }
        }, $routes);
    }
}
