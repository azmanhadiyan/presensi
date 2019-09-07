<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi;

/**
 * AbsensiSearch represents the model behind the search form of `app\models\Absensi`.
 */
class AbsensiSearch extends Absensi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_presensi', 'id_jadwal', 'id_mahasiswa'], 'integer'],
            [['tanggal', 'foto', 'kehadiran'], 'safe'],
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
        $query = Absensi::find();

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
            'id_presensi' => $this->id_presensi,
            'id_jadwal' => $this->id_jadwal,
            'id_mahasiswa' => $this->id_mahasiswa,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'kehadiran', $this->kehadiran]);

        return $dataProvider;
    }
}
