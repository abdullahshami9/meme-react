<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Post;

class adminPostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('profile_id_fk', __('Profile id fk'));
        $grid->column('description', __('Description'));
        $grid->column('privacy', __('Privacy'));
        $grid->column('is_allow', __('Is allow'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('is_dis_allow_by', __('Is dis allow by'));
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('profile_id_fk', __('Profile id fk'));
        $show->field('description', __('Description'));
        $show->field('privacy', __('Privacy'));
        $show->field('is_allow', __('Is allow'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('is_dis_allow_by', __('Is dis allow by'));
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
        $form = new Form(new Post());

        $form->number('profile_id_fk', __('Profile id fk'));
        $form->textarea('description', __('Description'));
        $form->number('privacy', __('Privacy'));
        $form->text('is_allow', __('Is allow'));
        $form->text('is_dis_allow_by', __('Is dis allow by'));
        $form->text('is_dis_allow_reason', __('Is dis allow reason'));

        return $form;
    }
}
