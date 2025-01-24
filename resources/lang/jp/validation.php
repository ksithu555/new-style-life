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

    'accepted' => ':attributeを承認してください',
    'active_url' => ':attributeが有効なURLではありません',
    'after' => ':attributeには、:date以降の日付を指定してください',
    'after_or_equal' => ':attributeには、:date以降もしくは同日時を指定してください',
    'alpha' => ':attributeには、アルファベッドのみ使用できます',
    'alpha_dash' => ':attributeには、英数字とダッシュ(-)及び下線(_)が使用できます',
    'alpha_num' => ':attributeには、英数字が使用できます',
    'array' => ':attributeには、配列を指定してください',
    'before' => ':attributeには、:date以前の日付を指定してください',
    'before_or_equal' => ':attributeには、:date以前もしくは同日時を指定してください',
    'between' => [
        'numeric' => ':attributeには、:minから:maxまでの数字を指定してください',
        'file' => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください',
        'string' => ':attributeは:min文字から:max文字にしてください',
        'array' => ':attributeの項目は:min個から:max個にしてください',
    ],
    'boolean' => ':attributeには、trueかfalseを指定してください',
    'confirmed' => 'パスワードが一致しません',
    'date' => ':attributeは有効な日付ではありません',
    'date_equals' => ':attributeには、:dateと同じ日付を指定してください',
    'date_format' => ':attributeは:format形式で入力してください',
    'different' => ':attributeと:otherには、異なるものを指定してください',
    'digits' => ':attributeは:digits桁にしてください',
    'digits_between' => ':attributeは:min桁から:max桁にしてください',
    'dimensions' => ':attributeの画像サイズが無効です',
    'distinct' => ':attributeの値が重複しています',
    'email' => 'メールアドレスが正しくありません',
    'exists' => '選択された:attributeは正しくありません',
    'file' => ':attributeにはファイルを指定してください',
    'filled' => ':attributeに値を指定してください',
    'gt' => [
        'numeric' => ':attributeは:valueより大きくしてください',
        'file' => ':attributeは:value KBより大きくしてください',
        'string' => ':attributeは:value文字より大きくしてください',
        'array' => ':attributeの項目は:value個より多くしてください',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上にしてください',
        'file' => ':attributeは:value KB以上にしてください',
        'string' => ':attributeは:value文字以上にしてください',
        'array' => ':attributeの項目は:value個以上にしてください',
    ],
    'image' => ':attributeには画像ファイルを指定してください',
    'in' => '選択された:attributeは正しくありません',
    'in_array' => ':attributeは:otherに存在しません',
    'integer' => ':attributeは整数にしてください',
    'ip' => ':attributeには、有効なIPアドレスを指定してください',
    'ipv4' => ':attributeには、有効なIPv4アドレスを指定してください',
    'ipv6' => ':attributeには、有効なIPv6アドレスを指定してください',
    'json' => ':attributeには、有効なJSON文字列を指定してください',
    'lt' => [
        'numeric' => ':attributeは:valueより小さくしてください',
        'file' => ':attributeは:value KBより小さくしてください',
        'string' => ':attributeは:value文字より小さくしてください',
        'array' => ':attributeの項目は:value個より少なくしてください',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下にしてください',
        'file' => ':attributeは:value KB以下にしてください',
        'string' => ':attributeは:value文字以下にしてください',
        'array' => ':attributeの項目は:value個以下にしてください',
    ],
    'max' => [
        'numeric' => ':attributeは:max以下にしてください',
        'file' => ':attributeは:max KB以下にしてください',
        'string' => ':attributeは:max文字以下にしてください',
        'array' => ':attributeの項目は:max個以下にしてください',
    ],
    'mimes' => ':attributeは:valuesタイプのファイルを指定してください',
    'mimetypes' => ':attributeは:valuesタイプのファイルを指定してください',
    'min' => [
        'numeric' => ':attributeは:min以上にしてください',
        'file' => ':attributeは:min KB以上にしてください',
        'string' => ':attributeは:min文字以上にしてください',
        'array' => ':attributeの項目は:min個以上にしてください',
    ],
    'multiple_of' => ':attributeは:valueの倍数にしてください',
    'not_in' => '選択された:attributeは正しくありません',
    'not_regex' => ':attributeの形式が正しくありません',
    'numeric' => ':attributeには、数字を指定してください',
    'password' => 'パスワードが正しくありません',
    'present' => ':attributeが存在していません',
    'regex' => ':attributeに正しい形式を指定してください',
    'required' => ':attributeは必須です',
    'required_if' => ':otherが:valueの場合、:attributeは必須です',
    'required_unless' => ':otherが:valuesでない場合、:attributeは必須です',
    'required_with' => ':valuesが存在する場合、:attributeは必須です',
    'required_with_all' => ':valuesが存在する場合、:attributeは必須です',
    'required_without' => ':valuesが存在しない場合、:attributeは必須です',
    'required_without_all' => ':valuesが存在しない場合、:attributeは必須です',
    'prohibited' => ':attributeは入力禁止です',
    'prohibited_if' => ':otherが:valueの場合、:attributeは入力禁止です',
    'prohibited_unless' => ':otherが:valuesでない場合、:attributeは入力禁止です',
    'same' => ':attributeと:otherは同じでなければなりません',
    'size' => [
        'numeric' => ':attributeは:sizeにしてください',
        'file' => ':attributeは:size KBにしてください',
        'string' => ':attributeは:size文字にしてください',
        'array' => ':attributeの項目は:size個にしてください',
    ],
    'starts_with' => ':attributeは:valuesで始まる必要があります',
    'string' => ':attributeは文字列にしてください',
    'timezone' => ':attributeは有効なタイムゾーンを指定してください',
    'unique' => ':attributeは既に存在します',
    'uploaded' => ':attributeのアップロードに失敗しました',
    'url' => ':attributeに正しい形式を指定してください',
    'uuid' => ':attributeは有効なUUIDでなければなりません',
    'pleasecheck' => '確認してください',
    'pleasefilltaskname' => 'リクエスト名は必須です',
    'pleasefilltaskmsg' => 'リクエストメッセージは必須です',
    'hcompanynamepleaseinput' => '会社名は必須です',
    'hcompanyfurinamepleaseinput' => '担当者名は必須です',
    'pleaseuploadimgfile' => '画像をアップロードしてください',
    'stockcountrequired' => '在庫数は必須です',

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
            'rule-name' => 'カスタムメッセージ',
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
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'name' => '名前',
        'furiname' => '姓',
        'gender' => '性別',
        'agerange' => '年齢層',
        'phone' => '電話番号',
        'types' => '分類種類',
        'b_type' => '大分類',
        'm_type' => '中分類',
        's_type' => '小分類',
        'fee' => 'チケット価格',
        'seminar_name' => 'セミナー名',
        'startdt' => '開始日時',
        'enddt' => '終了日時',
        'participant_limit' => '制限人数',
        'subjects' => '件名',
        'message' => 'お問い合わせ内容',
        'titled' => 'タイトル',
        'category' => 'カテゴリー',
        'subtitle' => 'サブタイトル',
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

        'address' => '住所',
        'compname' => '会社名',
        'entity' => 'エンティティ',
        'purpose' => '目的',
        'compindustry' => '業界',
        'position' => '役職',

        'deliveryperiod' => '納期',
        'contactmethod' => '連絡方法',
        'budget' => '予算',
        'infcgender' => 'インフルエンサーの性別',
        'infccountry' => 'インフルエンサーの国',
        'infcmedia' => '主要メディア',
        'infcgenre' => '主要ジャンル',
        'infcdesirepay' => '希望支払額',
        'city' => '市',

        'amountone' => '定価（税込）',
        'amounttwo' => '販売価格（税込）',
        'amountthr' => '卸売価格（税込）',
        'stockcount' => '在庫数',

        'country' => '国',

        'bankinfoone' => '銀行名',
        'bankinfotwo' => '支店名',
        'bankinfothr' => '口座番号',
        'bankinfofou' => '口座名義',

        'addressinfo' => '受取人住所',
        'addressone' => '郵便番号',
        'addresstwo' => '住所',
        'addressthr' => '名前',
        'addressfou' => '電話番号',

        'sendto' => '送付先',
        'shippinginclude' => '送料込み',

        'amountone' => '価格（税込）',
        'amounttwo' => '販売価格（税込）',
        'amountthr' => '卸売価格（税込）',
        'amountfou' => '電話番号',
        'stockcount' => '在庫数',
        'remainingstockcount' => '残り在庫数',

        'payvalue' => '支払額（税込）',
        'paydate' => '支払日',

        'companytitle' => '会社名',
        'tradeposition' => '取引ポジション',

        'keyone' => 'Zoomキー',
        'keytwo' => 'ZOOMシークレットキー',

        'image' => '画像',
        'seminar_name' => 'イベント名',
        'description' => 'イベント内容',
        'eventstart' => 'イベント開始',
        'eventend' => 'イベント終了',
        'makername' => 'メーカー名',
        'productattribute' => '製品属性',
    ],

];