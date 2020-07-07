<?php

namespace App\Library\Services\AppexNpayApi\Builder;

use App\Library\Services\AppexNpayApi\Data\Data;
use App\Library\Services\AppexNpayApi\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class ValidatePayload
 * @package App\Library\Services\AppexNpayApi\Builder
 */
trait ValidatePayload
{
    /**
     * @param array $data
     * @return array
     * @throws ValidatorException
     */
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'terminal' => 'required',
            'login' => 'required',
            'password' => 'required',
            'type' => [
                'required',
                Rule::in(Data::TYPE)
            ],
            'id' => 'required_if:type,new,status',
            'account' => 'required_if:type,new',
            'amount_in' => 'required_if:type,new|numeric|regex:/^[0-9]{1,}([.][0-9]{1,2})?$/iu',
            'amount_out' => 'required_if:type,new|numeric|regex:/^[0-9]{1,}([.][0-9]{1,2})?$/iu',
        ], $this->messages());

        if ($validator->fails()) {
            throw new ValidatorException($validator->errors());
        }

        return $data;
    }

    /**
     * @return array
     */
    private function messages(): array
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'in' => 'Выбранное значение для :attribute ошибочно.: ' . implode(',', Data::TYPE),
            'numeric' => 'Поле :attribute должно быть числом.',
            'regex' => 'Поле :attribute имеет ошибочный формат. Два знака после запятой.',
        ];
    }
}