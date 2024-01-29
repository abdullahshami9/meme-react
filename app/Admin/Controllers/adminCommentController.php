<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Comment;

class adminCommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'));
        $grid->column('description', __('Description'));
        $grid->column('is_allow', __('Is allow'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('is_dis_allow', __('Is dis allow'));
        $grid->column('is_dis_allow_reason', __('Is dis allow reason'));

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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('description', __('Description'));
        $show->field('is_allow', __('Is allow'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('is_dis_allow', __('Is dis allow'));
        $show->field('is_dis_allow_reason', __('Is dis allow reason'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Comment());

        $form->textarea('description', __('Description'));
        $form->switch('is_allow', __('Is allow'));
        $form->number('is_dis_allow', __('Is dis allow'));
        $form->text('is_dis_allow_reason', __('Is dis allow reason'));

        return $form;
    }
}
