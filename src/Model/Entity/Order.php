<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $client_id
 * @property string $total_price
 * @property string $complete
 * @property \Cake\I18n\DateTime $created
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\OrderProduct[] $order_products
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'client_id' => true,
        'total_price' => true,
        'complete' => true,
        'created' => true,
        'client' => true,
        'order_products' => true,
        'invoice' => true,
        'order_address' => true
    ];
}
