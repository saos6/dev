<?php

namespace App\Admin\Selectable;

use App\Models\Author;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class Authors extends Selectable
{
    public $model = Author::class;

    public function make()
    {
        $this->column('id');
        $this->column('first_name');
        $this->column('last_name');
        // $this->column('avatar','Avatar')->image();
        $this->column('created_at');

        $this->filter(function (Filter $filter) {
            $filter->like('first_name');
            $filter->like('last_name');
        });
    }
}