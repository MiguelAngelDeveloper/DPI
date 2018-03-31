<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'La :attribute no es una URL válida.',
    'after'                => 'La :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El :attributedebe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El :attribute puede contener solo letras.',
    'alpha_dash'           => 'El :attribute puede contener solo letras, números, y barras.',
    'alpha_num'            => 'El :attribute puede contener solo letras y números.',
    'array'                => 'El :attribute debe ser un array.',
    'before'               => 'El :attribute debe ser un fecha anterior :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El :attribute debe ser entre :min y :max.',
        'file'    => 'El :attribute debe ser entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe ser entre :min y :max carácteres.',
        'array'   => 'El :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser true o false.',
    'confirmed'            => 'LA confirmaciñon de :attribute no coincide.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => 'El :attribute does not match El format :format.',
    'different'            => 'El :attribute y :oElr must be different.',
    'digits'               => 'El :attribute must be :digits digits.',
    'digits_between'       => 'El :attribute debe estar entre :min y :max digits.',
    'dimensions'           => 'El :attribute has invalid image dimensions.',
    'distinct'             => 'El :attribute field has a duplicate value.',
    'email'                => 'El :attribute must be a valid email address.',
    'exists'               => 'El selected :attribute is invalid.',
    'file'                 => 'El :attribute must be a file.',
    'filled'               => 'El :attribute field must have a value.',
    'image'                => 'El :attribute must be an image.',
    'in'                   => 'El selected :attribute is invalid.',
    'in_array'             => 'El :attribute field does not exist in :oElr.',
    'integer'              => 'El :attribute must be an integer.',
    'ip'                   => 'El :attribute must be a valid IP address.',
    'ipv4'                 => 'El :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'El :attribute must be a valid IPv6 address.',
    'json'                 => 'El :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'El campo :attribute no puede ser mayor de :max.',
        'file'    => 'El campo :attribute no puede ser mayor de :max kilobytes.',
        'string'  => 'El campo :attribute no puede ser mayor de :max carácteres.',
        'array'   => 'El campo :attribute no puede tener más de :max items.',
    ],
    'mimes'                => 'El :attribute must be a file of type: :values.',
    'mimetypes'            => 'El :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe ser al menos :min.',
        'file'    => 'El :attribute debe ser al menos de :min kilobytes.',
        'string'  => 'El :attribute debe ser al menos de :min carácteres.',
        'array'   => 'El :attribute debe tener al menos :min items.',
    ],
    'not_in'               => 'El seleccionado :attribute no es válido.',
    'numeric'              => 'El :attribute debe ser un número.',
    'present'              => 'El campo :attribute  debe estar presente.',
    'regex'                => 'El :attribute formato es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuyo :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuyo :values esté presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuyo :values esté presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuyo :values no esté presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuyo ninguno de :values estén presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser de :size.',
        'file'    => 'El :attribute debe ser de :size kilobytes.',
        'string'  => 'El :attribute debe ser de :size carácteres.',
        'array'   => 'El :attribute debe contener :size items.',
    ],
    'string'               => 'El :attribute debe ser un string.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => 'El :attribute ya ha sido usado.',
    'uploaded'             => 'El :attribute ha fallado en la subida.',
    'url'                  => 'El :attribute formato no es válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
