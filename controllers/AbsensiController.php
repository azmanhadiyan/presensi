<?php

namespace app\controllers;

use Yii;
use app\models\Absensi;
use app\models\AbsensiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Mpdf\Mpdf;
use kartik\export\ExportMenu;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * AbsensiController implements the CRUD actions for Absensi model.
 */
class AbsensiController extends Controller
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
     * Lists all Absensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Absensi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Absensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Absensi();

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = date('Y-m-d');
            $name = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));

            $structure = '../files/'.$name;
            //membuat folder
             if (!mkdir($structure, 0777, true)) {
                die('Gagal membuat folder...');
            }else{
                $model->folder = $structure;
            }

            $img = UploadedFile::getInstance($model, 'foto');
            if (!empty($img)) {
                if(is_object($img))
                {
                    $model->foto = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
                    $model->foto .='img.'.$img->extension;

                    $path = $structure."/".$model->foto;
                    $img->saveAs($path, false);
                }
            }
            $model->save();

            return $this->redirect(['view', 'id' => $model->id_presensi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Absensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_presensi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Absensi model.
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
     * Finds the Absensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Absensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Absensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

   public function actionExport() {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $filename    = time() . '_Excel.xlsx'; // Penamaan dari filenya berikut fungsi time() yang berguna untuk penamaan unik berdasarkan waktu
        $path        = 'exports/' . $filename; // Lokasi penyimpanan File

        $sheet->setCellValue('A1', 'No.');
        $sheet->setCellValue('B1', 'Jadwal');
        $sheet->setCellValue('C1', 'Mahasiswa');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Foto');
        $sheet->setCellValue('F1', 'Kehadiran');
        $datakelasatlet = Absensi::find()->all();
        $nomor     = 1;
        $row1      = 2;
        $row2      = $row1;
        $row3      = $row2;
        $row4      = $row3;
        $row5      = $row4;
        $row6      = $row5;

        foreach ($dataabsensi as $absensi) {
            $sheet->setCellValue('A' . $row1++, $nomor++);
            $sheet->setCellValue('B' . $row2++, $absensi->getNamaJadwal());
            $sheet->setCellValue('C' . $row3++, $absensi->getIdMahasiswa());
            $sheet->setCellValue('D' . $row4++, $absensi->$tanggal);
            $sheet->setCellValue('E' . $row5++, $absensi->$foto);
            $sheet->setCellValue('F' . $row6++, $absensi->$kehadiran);
        }

        $spreadsheet->getActiveSheet()
            ->getStyle('A1:F' . $row6)
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx'); // Disimpan berdasarkan format 'Xlxs'
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename); // Disimpan didalam lokasi yang telah ditentukan
        return $this->redirect($filename); // Redirect menuju halaman ini.
    }

   
}
