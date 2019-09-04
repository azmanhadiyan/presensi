<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presensi;

/**
 * PresensiSearch represents the model behind the search form of `app\models\Presensi`.
 */
class PresensiSearch extends Presensi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_presensi', 'id_mahasiswa', 'id_dosen', 'id_matakuliah'], 'integer'],
            [['Tgl_presensi', 'hasil_presensi'], 'safe'],
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
        $query = Presensi::find();

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
            'id_mahasiswa' => $this->id_mahasiswa,
            'id_dosen' => $this->id_dosen,
            'id_matakuliah' => $this->id_matakuliah,
            'Tgl_presensi' => $this->Tgl_presensi,
        ]);

        $query->andFilterWhere(['like', 'hasil_presensi', $this->hasil_presensi]);

        return $dataProvider;
    }
}
