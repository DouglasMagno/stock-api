<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ProductRequest extends FormRequest
{
    private $rulesPost = Product::RULES_POST;
    private $rulesPut = Product::RULES_PUT;
    private $rulesDelete = Product::RULES_DELETE;
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
        $rules = [];
        $rulesAvailable = (object)[
            'POST' => $this->rulesPost,
            'PUT' => $this->rulesPut,
            'DELETE' => $this->rulesDelete,
        ];

        if (isset($rulesAvailable->{mb_strtoupper($this->method())})){
            $rules = $rulesAvailable->{mb_strtoupper($this->method())};
        }
        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
                'validation' => $validator->errors()], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
