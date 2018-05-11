<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "personnel".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $name
 * @property string $nameSotrud
 * @property string $phone
 * @property integer $action
 * @property string $job_duties
 * @property integer $shedule
 * @property string $password
 * @property integer $bonus
 *
 * @property Financy[] $financies
 * @property PersonnelPosition[] $personnelPositions
 * @property Shifts[] $shifts
 */
class Personnel extends \yii\db\ActiveRecord
{
    const WORK = 0;
    const DISMISSAL = 1;

    const SHEDULE_DOUBLE = 1;
    const SHEDULE_WEEKdAYS = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personnel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'name', 'phone'], 'required'],
            [['action', 'bonus', 'shedule'], 'integer'],
            [['last_name', 'name'], 'string', 'max' => 50],
            [['job_duties', 'password'], 'string', 'max' => 86],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'name' => 'Имя',
            'nameSotrud' => 'Фамилия и имя',
            'phone' => 'Телефон',
            'action' => 'Action',
            'job_duties' => 'Должностные обязанности',
            'shedule' => 'График работы',
            'password' => 'Код подтверждение',
            'positions' => 'Должность',
            'bonus' => 'Премия'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonnelPosition()
    {
        return $this->hasMany(PersonnelPosition::className(), ['personnel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['id' => 'position_id'])->via('personnelPosition');
    }

    /**
     * @return string
     */
    public function getNameSotrud()
    {
        return $this->last_name.' '.$this->name;
    }

    /**
     * @return string
     */
    public function getPositionsAsString()
    {
        $arr = ArrayHelper::map($this->positions, 'id', 'name');
        return implode(', ', $arr);
    }

    /**
     * @return array
     */
    public static function getSheduleArray()
    {
        return [
            self::SHEDULE_DOUBLE => '2/2',
            self::SHEDULE_WEEKdAYS => '5/2'
        ];
    }

    public function getSheduleName()
    {
        return ArrayHelper::getValue(self::getSheduleArray(), $this->shedule);
    }

    public static function getSotrud()
    {
        return [
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Филипсон Алексей Александрович', 'Телефон' => '8(904)766-98-36', 'Магазин' => 'СИБ', 'График работы' => '8:00-20:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Князева Виктория Сергеевна', 'Телефон' => '8(953)405-74-76', 'Магазин' => 'МСК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Верхотин Линар Раисович', 'Телефон' => '8(986)913-27-36', 'Магазин' => 'ПШК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Метлякова Елизавета Анатольевна', 'Телефон' => '8(913)744-92-76', 'Магазин' => 'ПШК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Семенова Алина Сайфуллаевна', 'Телефон' => '8(960)043-15-94', 'Магазин' => 'ПШК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Марданшина Алена Айдаровна', 'Телефон' => '8(917)874-38-53', 'Магазин' => 'ПШК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Шарипова Валерия Рифовна', 'Телефон' => '8(903)388-09-48', 'Магазин' => 'СИБ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Иванова Ирина Васильевна', 'Телефон' => '8(917)245-86-25', 'Магазин' => 'СИБ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Свиридова Альбина Олеговна', 'Телефон' => '8(906)115-74-19', 'Магазин' => 'МСК', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Ермолаева Татьяна Валерьевна', 'Телефон' => '8(917)854-95-30', 'Магазин' => 'ЧЕТ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Исхакова Эндже Ильнуровна', 'Телефон' => '8(958)623-33-16', 'Магазин' => 'ЧЕТ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Сотрудник магазина', 'Имя' => 'Валагина Татьяна Евгеньевна', 'Телефон' => '8(937)003-79-08', 'Магазин' => 'СИБ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все, что касается магазина, в рамках смены'],
            ['Должность' => 'Системный администратор', 'Имя' => 'Кочнев Данил Викторович', 'Телефон' => '8(960)041-89-30', 'Магазин' => 'HQ', 'График работы' => '9:00-18:00', 'Вопросы' => 'Все технические приспособления'],
            ['Должность' => 'Администратор', 'Имя' => 'Яценко Ольга Витальевна', 'Телефон' => '8(906)110-60-96', 'Магазин' => 'HQ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Все заказы, клиенты, партнеры компании'],
            ['Должность' => 'Закупщик', 'Имя' => 'Иванова Ольга Юрьевна', 'Телефон' => '8(939)734-41-12', 'Магазин' => 'СИБ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Товары, услуги, комплектующие, ценообразование, учет товаров, инкассация'],
            ['Должность' => 'Дизайнер', 'Имя' => 'Хамидуллина Эллина Тагировна', 'Телефон' => '8(904)717-89-59', 'Магазин' => 'HQ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Эстетика, визуальное оформление, подготовка макетов, разработка дизайна'],
            ['Должность' => 'Мастер', 'Имя' => 'Закиров Альберт Галиевич', 'Телефон' => '8(927)030-35-78', 'Магазин' => 'HQ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Сублимация и печать на всем'],
            ['Должность' => 'Курьер', 'Имя' => 'Романов Глеб Дмитриевич', 'Телефон' => '8(927)240-82-72', 'Магазин' => 'HQ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Доставка по заказам, товарам, комплектующим, курьерские задачи'],
            ['Должность' => 'Руководитель по развитию и управлению изменениями', 'Имя' => 'Абсалямов Руслан Михайлович', 'Магазиг' => 'HQ', 'Телефон' => '8(950)316-42-33', 'Магазин' => 'HQ', 'График работы' => '9:00-18:00', 'Вопросы' => 'Система управления заказами, IT-вопросы, усовершенствование методов работы, предложения и идеи по развитию, проекты, программная разработка'],
            ['Должность' => 'HR специалист', 'Имя' => 'Сибгатуллина Алсу Рафаэлевна', 'Магазиг' => 'HQ', 'Телефон' => '8(965)592-55-25', 'Магазин' => 'HQ', 'График работы' => '9:00-18:00', 'Вопросы' => 'Подбор и обучение персонала'],
            ['Должность' => 'Управляющий', 'Имя' => 'Ленина Светлана Николаевна', 'Телефон' => '8(967)363-56-88', 'Магазин' => 'HQ', 'График работы' => '9:00-17:00', 'Вопросы' => 'Графики и смены, предложения и идеи по совершенствованию, карьерный рост'],
            ['Должность' => 'Бухгалтер', 'Имя' => 'Закиров Альберт Галиевич', 'Телефон' => '8(927)030-35-78', 'Магазин' => 'HQ', 'График работы' => '8:00-21:00', 'Вопросы' => 'Зарплаты, соц.пакеты, отпуска, юридическая защита'],
            ['Должность' => 'Специалист по кадрам', 'Имя' => 'Закиев Дамир Валерьевич', 'Телефон' => '8(927)439-35-02', 'Магазин' => 'HQ', 'График работы' => '8:00-21:00', 'Вопросы' => 'Переквалификация, обучение, аттестация, повышение, карьерный рост'],
            ['Должность' => 'Директор', 'Имя' => 'Закиров Альберт Галиевич', 'Телефон' => '8(927)030-35-78', 'Магазин' => 'HQ', 'График работы' => '8:00-21:00', 'Вопросы' => 'Финансовые вопросы, стратегическое развитие и управление'],
            ['Должность' => 'Директор', 'Имя' => 'Закиев Дамир Валерьевич', 'Телефон' => '8(927)439-35-02', 'Магазин' => 'HQ', 'График работы' => '8:00-21:00', 'Вопросы' => 'Совершенствование бизнес-процессов, стратегическое развитие и управление'],
        ];
    }

    public static function getShop()
    {
        return [
            ['Название' => 'Штаб-квартира', 'Телефон' => '216-36-96', 'Адрес' => 'Островского 87', 'Почта' => 'zakaz@holland-store.ru / holland.control.kzn@gmail.com'],
            ['Название' => 'Магазин', 'Телефон' => '8(903)314-73-92', 'Адрес' => 'Пушкина 5', 'Почта' => 'zakaz@holland-store.ru./zakaz@holland-store.ru'],
            ['Название' => 'Магазин', 'Телефон' => '8(903)306-24-31', 'Адрес' => 'Сибирский тракт 16', 'Почта' => 'zakaz@holland-store.ru./zakaz@holland-store.ru'],
            ['Название' => 'Магазин', 'Телефон' => '8(927)043-50-89', 'Адрес' => 'Волгоградская 2Б', 'Почта' => 'zakaz@holland-store.ru./zakaz@holland-store.ru'],
            ['Название' => 'Магазин', 'Телефон' => '', 'Адрес' => 'Четаева д.35', 'Почта' => 'zakaz@holland-store.ru./zakaz@holland-store.ru'],
        ];
    }
}
