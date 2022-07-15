<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'capacity' => 'required|numeric',
            'ticket_price' => 'required|numeric',
            'status' => 'required|in:open,close',
            'photo' => 'nullable|file|image',
            'operation_time' => 'nullable|array',
            'operation_time.*.day' => 'nullable|string',
            'operation_time.*.open_time' => 'nullable|string',
            'operation_time.*.close_time' => 'nullable|string',
        ];
    }
}
