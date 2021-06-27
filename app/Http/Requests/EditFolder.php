<?php

namespace App\Http\Requests;

use App\Folder;
use Illuminate\Validation\Rule;

class EditFolder extends CreateFolder
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        return $rule;
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes;
    }
}
