<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $address
 * @property string $email
 * @property string $country
 * @property string|null $vat_number
 * @property string $tax_code
 * @property string $newsletter
 * @property string $privacy
 *
 * @property \App\Model\Entity\Order[] $orders
 */
class Client extends Entity
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
        'name' => true,
        'surname' => true,
        'address' => true,
        'email' => true,
        'country' => true,
        'vat_number' => true,
        'tax_code' => true,
        'newsletter' => true,
        'privacy' => true,
        'invoice' => true
    ];
}
