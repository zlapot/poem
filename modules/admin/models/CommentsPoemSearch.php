<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CommentsPoem;

/**
 * CommentsPoemSearch represents the model behind the search form about `app\modules\admin\models\CommentsPoem`.
 */
class CommentsPoemSearch extends CommentsPoem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_poem', 'id_user', 'utime'], 'integer'],
            [['comment', 'date'], 'safe'],
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
        $query = CommentsPoem::find();

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
            'id_poem' => $this->id_poem,
            'id_user' => $this->id_user,
            'utime' => $this->utime,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'date', $this->date]);

        return $dataProvider;
    }
}
