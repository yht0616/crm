<?php

/**
 * This is the model class for table "ops".
 *
 * The followings are the available columns in table 'ops':
 * @property integer $id
 * @property string $ops_number
 * @property integer $invoice_id
 * @property integer $client_id
 * @property integer $user_id
 * @property integer $date
 */
class Ops extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ops';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ops_number, client_id, user_id, date', 'required'),
            array('invoice_id, client_id, user_id, date', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ops_number, invoice_id, client_id, user_id, date', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ops' => array(self::HAS_ONE,'Invoices','ops_id'),
            'users' => array(self::BELONGS_TO,'Users','user_id'),
            'client' => array(self::BELONGS_TO,'Clients','client_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ops_number' => 'Ops Number',
            'invoice_id' => 'Invoice',
            'client_id' => 'Client',
            'user_id' => 'User',
            'date' => 'Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('ops_number',$this->ops_number,true);
        $criteria->compare('invoice_id',$this->invoice_id);
        $criteria->compare('client_id',$this->client_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('date',$this->date);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ops the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}