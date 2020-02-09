<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksUpdateRequest extends FormRequest
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
            'title' => 'nullable|min:2|max:100',
            'description' => 'nullable|min:2|max:65535',
            'status' => 'nullable|in:todo,in-progress,done'
        ];
    }

    public function updateTask()
    {
        $this->task->update($this->all());

        return $this->task->fresh();
    }
}
