<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jadwal;

/**
 * JadwalSearch represents the model behind the search form of `app\models\Jadwal`.
 */
class JadwalSearch extends Jadwal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jadwal', 'id_matakuliah', 'id_kelas', 'id_ruangan', 'id_dosen'], 'integer'],
            [['jam', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Jadwal::find();

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
            'id_jadwal' => $this->id_jadwal,
            'jam' => $this->jam,
            'id_matakuliah' => $this->id_matakuliah,
            'id_kelas' => $this->id_kelas,
            'id_ruangan' => $this->id_ruangan,
            'id_dosen' => $this->id_dosen,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
