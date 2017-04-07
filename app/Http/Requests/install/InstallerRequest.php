<?php

namespace App\Http\Requests\install;

use App\Http\Requests\Request;

/**
 * InstallerRequest.
 *
 * @author  Ladybird <info@ladybirdweb.com>
 */
class InstallerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password'        => 'required|min:6',
            'confirmpassword' => 'required|same:password',
        ];
    }
}
