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

    'accepted'        => 'El :attribute debe ser aceptado.',
    'accepted_if'     => 'El :attribute debe aceptarse cuando :other es :value.',
    'active_url'      => 'El :attribute no es una URL válida.',
    'after'           => 'El :attribute debe ser una fecha posterior :date.',
    'after_or_equal'  => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'           => 'El :attribute solo debe contener letras.',
    'alpha_dash'      => 'El :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num'       => 'El :attribute solo debe contener letras y números.',
    'array'           => 'El :attribute debe ser una matriz.',
    'ascii'           => 'El :attribute solo debe contener caracteres alfanuméricos y símbolos de un solo byte.',
    'before'          => 'El :attribute debe ser una fecha anterior :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior or igual a :date.',
    'between'         => [
        'array'   => 'El :attribute debe tener entre :min y :max elementos.',
        'file'    => 'El :attribute debe estar entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string'  => 'El :attribute debe estar entre :min y :max caracteres.',
    ],
    'boolean'           => 'El :attribute el campo debe ser verdadero o falso.',
    'confirmed'         => 'El :attribute la confirmación no coincide.',
    'current_password'  => 'El password es incorrecto.',
    'date'              => 'El :attribute no es una fecha válida.',
    'date_equals'       => 'El :attribute debe ser una fecha igual a :date.',
    'date_format'       => 'El campo no coincide con el formato :format.',
    'decimal'           => 'El :attribute debe tener :decimal decimales.',
    'declined'          => 'El :attribute debe ser rechazado.',
    'declined_if'       => 'El :attribute debe rechazarse cuando :other es :value.',
    'different'         => 'El :attribute and :other debe ser diferente.',
    'digits'            => 'El :attribute debe ser :digits digitos.',
    'digits_between'    => 'El :attribute debe estar entre :min y :max digitos.',
    'dimensions'        => 'El :attribute tiene dimensiones de imagen no válidas.',
    'distinct'          => 'El :attribute el campo tiene un valor duplicado.',
    'doesnt_end_with'   => 'El :attribute no puede terminar con uno de los siguientes: :values.',
    'doesnt_start_with' => 'El :attribute no puede comenzar con uno de los siguientes: :values.',
    'email'             => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with'         => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'enum'              => 'El dato seleccionado :attribute es inválido.',
    'exists'            => 'El dato seleccionado :attribute es inválido.',
    'file'              => 'El :attribute debe ser un archivo.',
    'filled'            => 'El :attribute campo debe tener un valor.',
    'gt'                => [
        'array'   => 'El :attribute debe tener más que :value elementos.',
        'file'    => 'El :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'string'  => 'El :attribute debe ser mayor que :value caracteres.',
    ],
    'gte'               => [
        'array'   => 'El :attribute debe tener :value artículos o más.',
        'file'    => 'El :attribute debe ser mayor que or igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor que or igual a :value.',
        'string'  => 'El :attribute debe ser mayor que or igual a :value caracteres.',
    ],
    'image'             => 'El :attribute debe ser una imagen.',
    'in'                => 'El dato seleccionado :attribute es inválido.',
    'in_array'          => 'El :attribute field no existe en :other.',
    'integer'           => 'El :attribute debe ser un entero.',
    'ip'                => 'El :attribute debe ser una dirección IP válida.',
    'ipv4'              => 'El :attribute debe ser una dirección IPv4 válida.',
    'ipv6'              => 'El :attribute debe ser una dirección IPv6 válida.',
    'json'              => 'El :attribute debe ser un texto en JSON válida.',
    'lowercase'         => 'El :attribute debe estar en minúsculas.',
    'lt'                => [
        'array'   => 'El :attribute debe tener menos de :value elementos.',
        'file'    => 'El :attribute debe ser menor que :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor que :value.',
        'string'  => 'El :attribute debe ser menor que :value caracteres.',
    ],
    'lte' => [
        'array'   => 'El :attribute no debe tener más de :value elementos.',
        'file'    => 'El :attribute debe ser menor que o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor que o igual a :value.',
        'string'  => 'El :attribute debe ser menor que o igual a :value caracteres.',
    ],
    'mac_address' => 'El :attribute debe ser una dirección MAC válida.',
    'max' => [
        'array'   => 'El :attribute no debe tener más de :max elementos.',
        'file'    => 'El archivo no debe ser mayor que :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'string'  => 'El :attribute no debe ser mayor que :max caracteres.',
    ],
    'max_digits'  => 'El :attribute no debe tener más de :max digitos.',
    'mimes'       => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'   => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array'   => 'El :attribute debe tener al menos :min elementos.',
        'file'    => 'El :attribute al menos debe ser :min kilobytes.',
        'numeric' => 'El :attribute al menos debe ser :min.',
        'string'  => 'El :attribute al menos debe ser :min caracteres.',
    ],
    'min_digits'           => 'El :attribute debe tener al menos :min digitos.',
    'missing'              => 'El :attribute el campo desde estar desaparecido.',
    'missing_if'           => 'El :attribute el campo desde estar desaparecido cuando :other es :value.',
    'missing_unless'       => 'El :attribute el campo desde estar desaparecido a menos que :other es :value.',
    'missing_with'         => 'El :attribute el campo desde estar desaparecido cuando :values es presente.',
    'missing_with_all'     => 'El :attribute el campo desde estar desaparecido cuando :values está presente.',
    'multiple_of'          => 'El :attribute debe ser múltiplo de :value.',
    'not_in'               => 'El dato seleccionado :attribute es inválido.',
    'not_regex'            => 'El :attribute tiene un formato inválido.',
    'numeric'              => 'El :attribute tiene que ser un número.',
    'password'          => [
        'letters'       => 'El :attribute debe contener al menos una letra.',
        'mixed'         => 'El :attribute debe contener al menos una mayúscula y una minúscula.',
        'numbers'       => 'El :attribute debe contener al menos una número.',
        'symbols'       => 'El :attribute debe contener al menos una simbolo.',
        'uncompromised' => 'El dato :attribute ha aparecido en una fuga de datos. Por favor, elija un diferente :attribute.',
    ],
    'present'              => 'El :attribute es un campo que debe estar presente.',
    'prohibited'           => 'El :attribute es un campo que está prohibido.',
    'prohibited_if'        => 'El :attribute es un campo prohibido cuando :other es :value.',
    'prohibited_unless'    => 'El :attribute es un campo prohibido a menos que :other está en :values.',
    'prohibits'            => 'El :attribute es un campo que prohíbe :other de estar presente.',
    'regex'                => 'El :attribute tiene un formato inválido.',
    'required'             => 'El campo es requerido.',
    'required_array_keys'  => 'El :attribute debe contener entradas para: :values.',
    'required_if'          => 'El :attribute es requerido cuando :other es :value.',
    'required_if_accepted' => 'El :attribute es requerido cuando :other es aceptado.',
    'required_unless'      => 'El :attribute es obligatorio a menos que :other está en :values.',
    'required_with'        => 'El :attribute es requerido cuando :values es presente.',
    'required_with_all'    => 'El :attribute es requerido cuando :values está presente.',
    'required_without'     => 'El :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El :attribute es requerido cuando ninguno de :values está presente.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'array'   => 'El :attribute debe contener :size elementos.',
        'file'    => 'El :attribute debe contener :size kilobytes.',
        'numeric' => 'El :attribute debe contener :size.',
        'string'  => 'El :attribute debe contener :size caracteres.',
    ],
    'starts_with' => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string'      => 'El :attribute debe ser una cadena de texto.',
    'timezone'    => 'El :attribute debe contener una zona horaria válida.',
    'unique'      => 'El :attribute ya se ha tomado.',
    'uploaded'    => 'El :attribute no se pudo cargar.',
    'uppercase'   => 'El :attribute debe contener mayúsculas.',
    'url'         => 'El :attribute debe contener una URL válida.',
    'ulid'        => 'El :attribute debe contener una ULID válida.',
    'uuid'        => 'El :attribute debe contener una UUID válida.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
