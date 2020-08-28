<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Currency;

/**
 * This command get currencies.
 *
 * This command get currencies.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CurrencyController extends Controller
{
    /**
     * This command get currencies.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        Yii::$app->db->createCommand()->truncateTable('currency')->execute();
        $data = simplexml_load_string(file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp'));
        foreach ($data as $key => $value) {
            $currency = new Currency();
            $currency->name = $value->Name;
            $currency->rate = $value->Value;
            if ($currency->save(false)) {
                echo  "Курс '{$value->Name}' успешно сохранен" . "\n";
            }
        }

        echo "\n" . "Курс валют обновлен успешно" . "\n";

        return ExitCode::OK;
    }
}
