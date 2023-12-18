<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\City;

class adminCityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'City';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new City());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('L1state_id', __('L1state id'));
        $grid->column('state_code', __('State code'));
        $grid->column('state_id', __('State id'));
        $grid->column('state_name', __('State name'));
        $grid->column('country_id', __('Country id'));
        $grid->column('country_code', __('Country code'));
        $grid->column('country_name', __('Country name'));
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('wikiDataId', __('WikiDataId'));

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
        $show = new Show(City::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('L1state_id', __('L1state id'));
        $show->field('state_code', __('State code'));
        $show->field('state_id', __('State id'));
        $show->field('state_name', __('State name'));
        $show->field('country_id', __('Country id'));
        $show->field('country_code', __('Country code'));
        $show->field('country_name', __('Country name'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('wikiDataId', __('WikiDataId'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new City());

        $form->text('name', __('Name'));
        $form->number('L1state_id', __('L1state id'));
        $form->text('state_code', __('State code'));
        $form->number('state_id', __('State id'));
        $form->text('state_name', __('State name'));
        $form->number('country_id', __('Country id'));
        $form->text('country_code', __('Country code'));
        $form->text('country_name', __('Country name'));
        $form->decimal('latitude', __('Latitude'));
        $form->decimal('longitude', __('Longitude'));
        $form->text('wikiDataId', __('WikiDataId'));

        return $form;
    }
}
