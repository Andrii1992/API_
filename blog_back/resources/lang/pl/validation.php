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

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być datą po :date.',
    'after_or_equal' => ':attribute musi być datą późniejszą lub równą :date.',
    'alpha' => ':attribute musi zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => ':attribute musi zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być datą przed: data.',
    'before_or_equal' => ':attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'numeric' => ':attribute must be between :min and :max.',
        'file' => ':attribute must be between :min and :max pozycji',
        'string' => ':attribute must be between :min and :max znaków.',
        'array' => ':attribute must have between :min and :max pozycji',
    ],
    'boolean' => ':attribute pole musi mieć wartość true lub false.',
    'confirmed' => ':attribute potwierdzenie nie pasuje.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie pasuje do formatu :format.',
    'different' => ':attribute i :other muszą być różne.',
    'digits' => ':attribute musi zawierać :digits cyfry.',
    'digits_between' => ':attribute musi zawierać się w przedziale od :min do :max cyfr.',
    'dimensions' => ':attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => ':attribute pole ma zduplikowaną wartość.',
    'email' => ':attribute musi być prawidłowym adresem e-mail.',
    'ends_with' => ':attribute musi kończyć się jednym z następujących elementów: :values.',
    'exists' => 'wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => ':attribute pole musi mieć wartość.',
    'gt' => [
        'numeric' => ':attribute musi być większa niż :value.',
        'file' => ':attribute musi być większe niż :value pozycji',
        'string' => ':attribute musi być większe niż :value znaków.',
        'array' => ':attribute musi być większy niż :value pozycji',
    ],
    'gte' => [
        'numeric' => ':attribute musi być większe niż lub równe :value.',
        'file' => ':attribute musi być większe niż lub równe :value pozycji',
        'string' => ':attribute musi być większe niż lub równe :value znaków.',
        'array' => ':attribute must have :value elementów lub więcej.',
    ],
    'image' => ':attribute musi być obrazem.',
    'in' => 'wybrany :attribute jest nieprawidłowy.',
    'in_array' => ':attribute pole nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być prawidłowym adresem IP.',
    'ipv4' => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6' => ':attribute musi być prawidłowym adresem IPv6.',
    'json' => ':attribute musi być prawidłowym ciągiem JSON.',
    'lt' => [
        'numeric' => ':attribute musi być mniejsze niż :value.',
        'file' => ':attribute musi być mniejsze niż :value pozycji',
        'string' => ':attribute musi być mniejsze niż :value znaków.',
        'array' => 'The :attribute must have less than :value pozycji',
    ],
    'lte' => [
        'numeric' => ':attribute musi być mniejsze niż lub równe :value.',
        'file' => ':attribute musi być mniejsze niż lub równe :value pozycji',
        'string' => ':attribute musi być mniejsze niż lub równe :value znaków.',
        'array' => ':attributenie może mieć więcej niż :value pozycji',
    ],
    'max' => [
        'numeric' => ':attribute nie może być większa niż :max.',
        'file' => ':attribute nie może być większa niż :max pozycji',
        'string' => ':attribute nie może być większa niż :max znaków.',
        'array' => ':attributenie może mieć więcej niż :max pozycji',
    ],
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => [
        'numeric' => ':attribute musi większy lub równy :min.',
        'file' => ':attribute musi mieć co najmniej :min kilobajtów.',
        'string' => ':attribute musi mieć co najmniej :min znaków.',
        'array' => ':attribute musi mieć co najmniej :min pozycji.',
    ],
    'multiple_of' => ':attribute musi być wielokrotnością :value.',
    'not_in' => 'wybrany :attribute jest nieprawidłowy.',
    'not_regex' => ':attribute format jest nieprawidłowy.',
    'numeric' => ':attribute musi być liczbą.',
    'password' => 'Hasło jest niepoprawne.',
    'present' => ':attribute musi być pole atrybutu.',
    'regex' => 'format :attribute jest nieprawidłowy',
    'required' => 'pole :attribute jest wymagane.',
    'required_if' => 'pole :attribute jest wymagane, gdy :other ma wartość :value.',
    'required_unless' => ':attribute pole jest wymagane, chyba że :other w :values.',
    'required_with' => 'pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_with_all' => 'pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_without' => 'pole :attribute jest wymagane, gdy :values nie są zdefiniowane.',
    'required_without_all' => 'pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.',
    'prohibited' => ':attribute pole jest zabronione.',
    'prohibited_if' => ':attribute pole jest zabronione, gdy :other to :value.',
    'prohibited_unless' => ':attribute pole jest zabronione, chyba :other jest w :values.',
    'same' => ':attribute i :other muszą być takie same.',
    'size' => [
        'numeric' => ':attribute must be :size.',
        'file' => ':attribute musi mieć :size kilobajtów.',
        'string' => ':attribute musi mieć :size znaków.',
        'array' => ':attribute musi zawierać :size pozycji.',
    ],
    'starts_with' => ':attribute musi zaczynać się od jednej z następujących wartości: :values.',
    'string' => ':attribute musi być string.',
    'timezone' => ':attribute musi być prawidłową strefą czasową.',
    'unique' => ':attribute jest już zajęty.',
    'uploaded' => ':attribute nie został przesłany.',
    'url' => 'format :attribute jest nieprawidłowy.',
    'uuid' => ':attribute musi być poprawnym UUID.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | with something more reader friendly such as 'E-Mail Address' instead
    | of 'email'. This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
