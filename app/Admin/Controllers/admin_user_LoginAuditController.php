<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\LoginAudit;

class admin_user_LoginAuditController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'LoginAudit';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LoginAudit());

        $grid->column('id', __('Id'));
        $grid->column('profile_id_fk', __('Profile id fk'));
        $grid->column('logout_at', __('Logout at'));
        $grid->column('login_at', __('Login at'));
        $grid->column('ip', __('Ip'));
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('country_id_fluctuation_by_ip_fk', __('Country id fluctuation by ip fk'));

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
        $show = new Show(LoginAudit::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('profile_id_fk', __('Profile id fk'));
        $show->field('logout_at', __('Logout at'));
        $show->field('login_at', __('Login at'));
        $show->field('ip', __('Ip'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('country_id_fluctuation_by_ip_fk', __('Country id fluctuation by ip fk'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new LoginAudit());

        $form->number('profile_id_fk', __('Profile id fk'));
        $form->datetime('logout_at', __('Logout at'))->default(date('Y-m-d H:i:s'));
        $form->datetime('login_at', __('Login at'))->default(date('Y-m-d H:i:s'));
        $form->ip('ip', __('Ip'));
        $form->text('latitude', __('Latitude'));
        $form->text('longitude', __('Longitude'));
        $form->number('country_id_fluctuation_by_ip_fk', __('Country id fluctuation by ip fk'));

        return $form;
    }
}
