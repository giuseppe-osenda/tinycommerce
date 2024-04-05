<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * CustomPages Controller
 *
 * @property \App\Model\Table\CustomPagesTable $CustomPages
 */
class CustomPagesController extends AppController
{

    public function view($id = null)
    {
        $item = $this->CustomPages->get($id);
        $this->set(compact('item')); // Set the item to be used in the view
        $this->render($item->title); // Render the view with the same name as the title
    }
}
