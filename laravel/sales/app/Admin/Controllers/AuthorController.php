<?php

namespace App\Admin\Controllers;

use App\Models\Author;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AuthorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Author';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Author());

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('名前'));
        $grid->column('last_name', __('氏名'));
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
        $show = new Show(Author::findOrFail($id));

        $show->field('id', __('Id'));
        $grid->column('first_name', __('名前'));
        $grid->column('last_name', __('氏名'));
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
        $form = new Form(new Author());

        // $form->text('first_name', __('名前'));
        // $form->text('last_name', __('氏名'));
        // // 通常モード
        // $form->tab('氏名',function($form) {
        //     $form->hidden('id');
        //     $form->text('first_name', '名前');
        //     $form->text('last_name', '氏名');
        // })->tab('本',function($form) {
        //     $form->hasMany('books','BOOK',function(Form\NestedForm $nestedForm) {
        //         $nestedForm->hidden('id');
        //         $nestedForm->text('title','タイトル');
        //         $nestedForm->text('subtitle','サブタイトル');
        //         $nestedForm->number('page','ページ数');
        //         $nestedForm->currency('price','価格');
        //     });
        // });
        // // タブモード
        // $form->tab('氏名',function($form) {
        //     $form->hidden('id');
        //     $form->text('first_name', '名前');
        //     $form->text('last_name', '氏名');
        // })->tab('本',function($form) {
        //     $form->hasMany('books','BOOK',function(Form\NestedForm $nestedForm) {
        //         $nestedForm->hidden('id');
        //         $nestedForm->text('title','タイトル');
        //         $nestedForm->text('subtitle','サブタイトル');
        //         $nestedForm->number('page','ページ数');
        //         $nestedForm->currency('price','価格');
        //     })->useTab();
        // });
        // デーブルモード
        $form->tab('氏名',function($form) {
            $form->hidden('id');
            $form->text('first_name', '名前');
            $form->text('last_name', '氏名');
        })->tab('本',function($form) {
            $form->hasMany('books','BOOK',function(Form\NestedForm $nestedForm) {
                $nestedForm->hidden('id');
                $nestedForm->text('title','タイトル');
                $nestedForm->text('subtitle','サブタイトル');
                $nestedForm->number('page','ページ数');
                $nestedForm->currency('price','価格');
            })->useTable();
        });

        return $form;
    }
}
