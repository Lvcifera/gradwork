<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketsRequest extends FormRequest
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
            'ticket_name' => 'required|min:10|max:50',
            'ticket_description' => 'required|min:15|max:500',
            'ticket_date_off' => 'nullable|date|after_or_equal:now',
        ];
    }
}
