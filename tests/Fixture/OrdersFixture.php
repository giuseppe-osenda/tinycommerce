<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'client_id' => 1,
                'total_price' => 1.5,
                'complete' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-04-05 09:24:03',
            ],
        ];
        parent::init();
    }
}
