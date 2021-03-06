<?php

namespace common\models\ar_origin;

use Yii;

/**
 * This is the model class for table "acl_roles".
 *
 * @property int $id
 * @property int $parent_ref
 * @property string $role_key
 * @property string $role_name
 * @property string $description
 */
class RArAclRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acl_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_ref'], 'default', 'value' => null],
            [['parent_ref'], 'integer'],
            [['role_key', 'role_name'], 'required'],
            [['role_key'], 'string', 'max' => 30],
            [['role_name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_ref' => 'Parent Ref',
            'role_key' => 'Role Key',
            'role_name' => 'Role Name',
            'description' => 'Description',
        ];
    }
}
