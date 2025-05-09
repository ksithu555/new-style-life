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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    // 'after' => 'The :attribute must be a date after :date.',
    'after' => ':attributeの設定が正しくありません',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The password does not match.',
    'confirmedpass' => ':attributeが一致しません',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => ':max桁以内に入力してくだい',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Email is incorrect.',
    'editemail' => '有効な:attributeを入力してください',
    'emails' => '有効な:attributeを入力してください',

    'content' => 'content:attributeを入力してください',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => '最大:max桁半角数字を入力してください',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute may not be greater than :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be present.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'pleasecheck' => 'Please Check',
    'pleasefilltaskname' => 'The request name field is required.',
    'pleasefilltaskmsg' => 'The request message field is required.',
    'hcompanynamepleaseinput' => 'The company name field is required.',
    'hcompanyfurinamepleaseinput' => 'The person in charge field is required.',
    'pleaseuploadimgfile' => 'Please upload an image',
    'stockcountrequired' => 'The Stockcount field is required.',



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

    'attributes' => [
        'email' => 'Mail Address',
        'password' => 'Password',
        'name' => 'Name',
        'furiname' => 'Last Name',
        'gender' => 'Sex',
        'agerange' => 'Age Range',
        'phone' => 'Phone',
        'types' => '分類種類',
        'b_type' => '大分類',
        'm_type' => '中分類',
        's_type' => '小分類',
        'fee' => 'チケット価格',
        'seminar_name' => 'セミナー氏名',
        'startdt' => 'Start',
        'enddt' => 'End',
        'participant_limit' => '制限人数',
        'subjects' => '件名',
        'message' => 'お問い合わせ内容',
        'titled' => 'タイトル',
        'category' => 'カテゴリー',
        'subjects' => 'Subject',
        'message' => 'Message',
        'title' => 'Category',
        'category' => 'Category',
        'subtitle' => 'Subtitle',
        'content' => '内容',
        'image' => 'イメージ',
        'bunrui' => '分類',
        'qname' => '問題名',
        'qtype' => '本文/質問',
        'ansformat' => '解答方式',
        'mark' => '配点',
        'qid' => '任意の番号',
        'testname' => '試験名',
        'testminute' => '試験時間(分)',
        'anskeyin' => '正解',
        'passkey' => '予約許可番号',

        'address' => 'Address',
        'compname' => 'Company Name',
        'entity' => 'Entity',
        'purpose' => 'Purpose',
        'compindustry' => 'Industry',
        'position' => 'Position',

        'deliveryperiod' => 'Delivery Period',
        'contactmethod' => 'Contact Method',
        'budget' => 'Budget',
        'infcgender'=>'Influncer Gender',
        'infccountry'=>'Influncer Country',
        'infcmedia'=>'Main Media',
        'infcgenre'=>'Main Genre',
        'infcdesirepay'=>'Desire Payment Range',
        'city'=>'City',

        'amountone'=>'定価（税込)',
        'amounttwo' => 'Selling Price (including tax)',
        'amountthr'=>'卸し価額（税込）',
        'stockcount'=>'在庫数',

        'country' => 'Country',

        'bankinfoone' => 'Bank Name',
        'bankinfotwo' => 'Branch Name',
        'bankinfothr' => 'Account No',
        'bankinfofou' => 'Account Name',


        'addressinfo' => 'Receipient Address',
        'addressone' => 'Postal Code',
        'addresstwo' => 'Address',
        'addressthr' => 'Name',
        'addressfou' => 'Phone',

        'sendto' => 'Destination',
        'shippinginclude' => 'Shipping Cost',

         'amountone' => 'Price (tax included)',
         'amounttwo' => 'Selling Price (including tax)',
         'amountthr' => 'Wholesale Price (tax included)',
         'amountfou' => 'xxxxx phone number',
         'stockcount' => 'Stockcount',
         'remainingstockcount' => 'Remaining Stock Count',

        'payvalue' => 'Payment Value (Including tax)',
        'paydate' => 'Payment Date',

        'companytitle' => 'Company Title',
        'tradeposition' => 'Trade Position',

        'keyone' => 'Zoom Key',
        'keytwo' => 'ZOOM Secret  Key',

        'image' => 'Image',
        'seminar_name' => 'Event Name',
        'description' => 'Event Content',
        'eventstart' => 'Event Start',
        'eventend' => 'Event End',
        'makername' => 'Maker Name',
        'productattribute' => 'Product Attribute',

    ],

 ];