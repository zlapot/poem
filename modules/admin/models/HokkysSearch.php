<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Hokkys;

/**
 * HokkysSearch represents the model behind the search form about `app\modules\admin\models\Hokkys`.
 */
class HokkysSearch extends Hokkys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'created_at', 'isDelete', 'status', 'censor'], 'integer'],
            [['hokky', 'autor', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Hokkys::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'censor' => $this->censor,
        ]);

        $query->andFilterWhere(['like', 'hokky', $this->hokky])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
