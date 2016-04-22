<?php

use Illuminate\Database\Seeder;
use Omega\Repositories\TrimesterRepositoryInterface;

class TrimestersTableSeeder extends Seeder
{
    /**
     * @var TrimesterRepositoryInterface
     */
    private $repository;

    /**
     * TrimestersTableSeeder constructor.
     * @param TrimesterRepositoryInterface $repository
     */
    public function __construct(TrimesterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($year = 2013; $year <= 2017; $year++) {
            for ($sequence = 1; $sequence <= 4; $sequence++) {
                $trimester_name = $this->makeName($year, $sequence);
                $this->repository->create(compact('year', 'sequence', 'trimester_name'));
            }
        }
    }

    protected function makeName($year, $sequence)
    {
        static $sequences = ['秋', '冬', '春', '夏'];
        return sprintf('%d-%d 学年%s季学期', $year, $year + 1, $sequences[$sequence - 1]);
    }
}
