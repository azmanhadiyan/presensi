<?php

namespace app\controllers;

use Yii;
use app\models\Jadwal;
use app\models\Absensi;
use app\models\Kelas;
use app\models\Mahasiswa;
use app\models\JadwalSearch;
use app\models\Matakuliah;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * JadwalController implements the CRUD actions for Jadwal model.
 */
class JadwalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jadwal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JadwalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jadwal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $jadwal = Jadwal::find()
                ->andWhere(['id_jadwal' => $id])
                ->one();

        $idkelas = $jadwal->id_kelas;

        $query = Absensi::find()
                ->andWhere(['id_jadwal' => $id]);

       $provider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
             'pageSize' => 2,
          ],
       ]);
       // returns an array of users objects
       $jadwal = $provider->getModels();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'jadwal' => $provider,
        ]);
    }

    /**
     * Creates a new Jadwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jadwal();
        
        if ($model->load(Yii::$app->request->post())) {
            $nama_jadwal = $model->getIdMatkul($model->id_matakuliah)." - ".$model->getIdKelas($model->id_kelas);
            $model->nama_jadwal = $nama_jadwal;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_jadwal]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Jadwal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_jadwal]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionStatus($id,$status)
    {
        $model = $this->findModel($id);
        $model->status = $status; 
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id_jadwal]);
        }
    }

    /**
     * Deletes an existing Jadwal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jadwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jadwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jadwal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDetail()
    {        
        if (isset($_POST['expandRowKey'])) {
            $kelas = Yii::$app->request->post('id_kelas');

            $model = Kelas::find()
                ->where(['mahasiswa' => $mahasiswa]);
            $dataProvider = new ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            return $this->renderPartial('_attendance-details', ['dataProvider' => $dataProvider]);

        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

    public function actionExportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $filename = time() . '_Excel.xlsx';
        $path = 'exports/' . $filename;

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Mahasiswa');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Kehadiran');
        $sheet->setCellValue('E1', 'Foto');

        $semuaBuku = Jadwal::find()->all();
        $nomor     = 1;
        $row1      = 2;
        $row2      = $row1;
        $row3      = $row2;
        $row4      = $row3;
        $row5      = $row4;

        foreach ($Semuapresensi as $id_presensi) {
           $sheet->setCellValue('A' . $row1++, $nomor++);
           $sheet->setCellValue('B' . $row2++, $id_presensi->id_mahasiswa);
           $sheet->setCellValue('C' . $row3++, $id_presensi->tanggal);
           $sheet->setCellValue('D' . $row4++, $id_presensi->kehadiran);
           $sheet->setCellValue('E' . $row5++, $id_presensi->foto);
           
       }

       $spreadsheet->getActiveSheet()
       ->getStyle('A1:E' . $row5)
       ->getAlignment()
       ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

       $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
       $writer = new Xlsx($spreadsheet);
       $writer->save($path);
       return $this->redirect($path);
   }

}
