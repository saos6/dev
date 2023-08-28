<?php

namespace App\Admin\Controllers;

use App\Models\Book;
use App\Admin\Selectable\Authors;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Book';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Book());

        // test
        $grid->quickSearch('title');
        // $grid->model()->whereIn('id', [1, 2, 3]);
        // $grid->model()->orderBy('id', 'desc');
        // $grid->title()->display(function ($title) {
        //     return "<span class='label'>$title</span>";
        // });
        // test

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('author_id', __('Author id'));

        // リレーション
        $grid->column('author.first_name', __('Author FirstName'));
        $grid->column('author.last_name', __('Author LastName'));

        // $grid->display('author.first_name', __('著者名'));
        // $grid->author()->authors('first_name');
        // $grid->authors()->display(function ($authors) {
        //     $authors = array_map(function ($author) {
        //         return "<span class='label label-success'>{$author['first_name']}   </span>";
        //     }, $authors);
    
        //     return join('&nbsp;', $authors);
        // });

        // $grid->director()->display(function($author_id) {
        //     return \Model\Author::find($author_id)->first_name;
        // });

        $grid->column('page', __('Page'));
        $grid->column('subtitle', __('Subtitle'));
        $grid->column('price', __('Price'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Book::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('author_id', __('Author id'));
        $show->field('author.first_name', __('Author FirstName'));
        $show->field('author.last_name', __('Author LastName'));
        $show->field('page', __('Page'));
        $show->field('subtitle', __('Subtitle'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Book());

        $form->text('title', __('Title'));
        // $form->number('author_id', __('Author id'));
        $form->belongsTo('author_id', Authors::class,'Author');

        $form->number('page', __('Page'));
        $form->text('subtitle', __('Subtitle'));
        $form->decimal('price', __('Price'));

        // $form->select('author_id')->options(AuthorController::all()->pluck('first_name','id'));

        return $form;
    }
}
