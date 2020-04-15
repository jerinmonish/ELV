<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $rules['event_name']           = 'required';
        $rules['event_description']    = 'required';
        $rules['event_scheduled_date'] = 'required|date_format:d-m-Y';
        $rules['event_scheduled']      = 'required|date_format:H:i';
        $rules['event_status']         = 'required';
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            break;
            case 'POST':
            {
                $rules['event_fname']        = 'required|max:20000|mimes:mp4,mov,ogg,qt';
            }
            case 'PUT':
            case 'PATCH':
            {
            }
            break;
        default:break;
        }
        return $rules;
    }
}
