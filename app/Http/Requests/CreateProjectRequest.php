<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id'         => 'required|exists:customers,id',
            'name'              => 'required|string|max:150|unique:projects,name',
            'description'       => 'nullable|string',
            'start_date'        => 'nullable|date',
            'est_period'        => 'nullable|integer',
            'time_unit'         => 'nullable|string|in:hours,days,weeks,months,years',
            'status'            => 'nullable|string|in:held,tender,ongoing,finished,pending',
            'project_type'      => 'nullable|string',
            'manager_id'        => 'nullable|exists:users,id',
            's_number'          => 'nullable|string|max:16|unique:projects,s_number',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'client_id.required'    => 'حقل العميل مطلوب.',
            'client_id.exists'      => 'العميل المحدد غير موجود.',
            'name.required'         => 'اسم المشروع مطلوب.',
            'name.unique'           => 'اسم المشروع مستخدم بالفعل.',
            'start_date.date'       => 'تاريخ البدء يجب أن يكون تاريخًا صالحًا.',
            'est_period.integer'    => 'الفترة التقديرية يجب أن تكون عددًا صحيحًا.',
            'time_unit.in'          => 'وحدة الوقت يجب أن تكون واحدة من: ساعات، أيام، أسابيع، أشهر، سنوات.',
            'status.in'             => 'الحالة يجب أن تكون واحدة من: معلق، مناقصة، جاري التنفيذ، منتهي، قيد الانتظار.',
            'manager_id.exists'     => 'المدير المحدد غير موجود.',
            's_number.unique'       => 'رقم المسلسل مستخدم بالفعل.',
        ];
    }
}
