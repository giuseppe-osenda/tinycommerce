<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomPage Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $text_1
 * @property string|null $text_2
 * @property string|null $text_3
 * @property string|null $text_4
 * @property string|null $text_5
 * @property string|null $string_1
 * @property string|null $string_2
 * @property string|null $string_3
 * @property string|null $string_4
 * @property string|null $string_5
 */
class CustomPage extends Entity
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
        'title' => true,
        'text_1' => true,
        'text_2' => true,
        'text_3' => true,
        'text_4' => true,
        'text_5' => true,
        'string_1' => true,
        'string_2' => true,
        'string_3' => true,
        'string_4' => true,
        'string_5' => true,
    ];
}
