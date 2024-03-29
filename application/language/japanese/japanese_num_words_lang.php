<?php

$lang['num_word_1']        = '一';
$lang['num_word_2']        = '二';
$lang['num_word_3']        = '三';
$lang['num_word_4']        = '四';
$lang['num_word_5']        = '五';
$lang['num_word_6']        = '六';
$lang['num_word_7']        = '七';
$lang['num_word_8']        = '八';
$lang['num_word_9']        = '九';
$lang['num_word_10']       = '十';
$lang['num_word_11']       = '十一';
$lang['num_word_12']       = '十二';
$lang['num_word_13']       = '十三';
$lang['num_word_14']       = '十四';
$lang['num_word_15']       = '十五';
$lang['num_word_16']       = '十六';
$lang['num_word_17']       = '十七';
$lang['num_word_18']       = '十八';
$lang['num_word_19']       = '十九';
$lang['num_word_20']       = '二十';
$lang['num_word_21']       = '二十一';
$lang['num_word_22']       = '二十二';
$lang['num_word_23']       = '二十三';
$lang['num_word_24']       = '二十四';
$lang['num_word_25']       = '二十五';
$lang['num_word_26']       = '二十六';
$lang['num_word_27']       = '二十七';
$lang['num_word_28']       = '二十八';
$lang['num_word_29']       = '二十九';
$lang['num_word_30']       = '三十';
$lang['num_word_31']       = '三十一';
$lang['num_word_32']       = '三十二';
$lang['num_word_33']       = '三十三';
$lang['num_word_34']       = '三十四';
$lang['num_word_35']       = '三十五';
$lang['num_word_36']       = '三十六';
$lang['num_word_37']       = '三十七';
$lang['num_word_38']       = '三十八';
$lang['num_word_39']       = '三十九';
$lang['num_word_40']       = '四十';
$lang['num_word_41']       = '四十一';
$lang['num_word_42']       = '四十二';
$lang['num_word_43']       = '四十三';
$lang['num_word_44']       = '四十四';
$lang['num_word_45']       = '四十五';
$lang['num_word_46']       = '四十六';
$lang['num_word_47']       = '四十七';
$lang['num_word_48']       = '四十八';
$lang['num_word_49']       = '四十九';
$lang['num_word_50']       = '五十';
$lang['num_word_51']       = '五十一';
$lang['num_word_52']       = '五十二';
$lang['num_word_53']       = '五十三';
$lang['num_word_54']       = '五十四';
$lang['num_word_55']       = '五十五';
$lang['num_word_56']       = '五十六';
$lang['num_word_57']       = '五十七';
$lang['num_word_58']       = '五十八';
$lang['num_word_59']       = '五十九';
$lang['num_word_60']       = '六十';
$lang['num_word_61']       = '六十一';
$lang['num_word_62']       = '六十二';
$lang['num_word_63']       = '六十三';
$lang['num_word_64']       = '六十四';
$lang['num_word_65']       = '六十五';
$lang['num_word_66']       = '六十六';
$lang['num_word_67']       = '六十七';
$lang['num_word_68']       = '六十八';
$lang['num_word_69']       = '六十九';
$lang['num_word_70']       = '七十';
$lang['num_word_71']       = '七十一';
$lang['num_word_72']       = '七十二';
$lang['num_word_73']       = '七十三';
$lang['num_word_74']       = '七十四';
$lang['num_word_75']       = '七十五';
$lang['num_word_76']       = '七十六';
$lang['num_word_77']       = '七十七';
$lang['num_word_78']       = '七十八';
$lang['num_word_79']       = '七十九';
$lang['num_word_80']       = '八十';
$lang['num_word_81']       = '八十一';
$lang['num_word_82']       = '八十二';
$lang['num_word_83']       = '八十三';
$lang['num_word_84']       = '八十四';
$lang['num_word_85']       = '八十五';
$lang['num_word_86']       = '八十六';
$lang['num_word_87']       = '八十七';
$lang['num_word_88']       = '八十八';
$lang['num_word_89']       = '八十九';
$lang['num_word_90']       = '九十';
$lang['num_word_91']       = '九十一';
$lang['num_word_92']       = '九十二';
$lang['num_word_93']       = '九十三';
$lang['num_word_94']       = '九十四';
$lang['num_word_95']       = '九十五';
$lang['num_word_96']       = '九十六';
$lang['num_word_97']       = '九十七';
$lang['num_word_98']       = '九十八';
$lang['num_word_99']       = '九十九';
$lang['num_word_100']      = '百';
$lang['num_word_200']      = '二百';
$lang['num_word_300']      = '三百';
$lang['num_word_400']      = '四百';
$lang['num_word_500']      = '五百';
$lang['num_word_600']      = '六百';
$lang['num_word_700']      = '七百';
$lang['num_word_800']      = '八百';
$lang['num_word_900']      = '九百';
$lang['num_word_thousand'] = '千';
$lang['num_word_million']  = '百万';
$lang['num_word_billion']  = '十億';
$lang['num_word_trillion'] = '兆';
$lang['num_word_zillion']  = 'ジリオン';
$lang['num_word_cents']    = 'セント';
$lang['number_word_and']   = 'And';

// Show in invoices and estimates
$lang['num_word'] = '言葉で';

$currencies = [
    'USD' => 'Dollars',
    'EUR' => 'Euros',
    'JPY' => '日本円',
];

$currencies = do_action('before_number_format_render_languge_currencies', $currencies);

foreach ($currencies as $key => $val) {
    $lang['num_word_' . strtoupper($key)] = $val;
}
