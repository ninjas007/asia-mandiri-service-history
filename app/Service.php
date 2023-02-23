<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function template()
    {
        return $this->hasOne(TemplateForm::class, 'id', 'template_form_id');
    }
}
