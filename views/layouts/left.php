<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i><?php 
               if (Yii::$app->user->identity->id_role) {
                 echo  Yii::$app->user->identity->id_role;
               }
                ?></a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
            $items = [];
            $items[] = ['label' => 'Menu Yii2', 'options' => ['class' => 'header']];
             if (Yii::$app->user->identity->id_role=='3'){

                         $items[] = ['label' => 'Presensi', 'icon' => 'dashboard', 'url' => ['/absensi']];
                         $items[] =['label' => 'Mahasiswa', 'icon' => 'dashboard', 'url' => ['/mahasiswa']];

                    } elseif (Yii::$app->user->identity->id_role=='2') {
                         $items[] =['label' => 'Presensi', 'icon' => 'dashboard', 'url' => ['/absensi']];
                         $items[] =['label' => 'Dosen', 'icon' => 'dashboard', 'url' => ['/dosen']];

                    }else{
                        $items[] =['label' => 'Presensi', 'icon' => 'dashboard', 'url' => ['/absensi']];
                        $items[] =['label' => 'Jadwal', 'icon' => 'dashboard', 'url' => ['/jadwal']];
                         $items[] =['label' => 'Dosen', 'icon' => 'dashboard', 'url' => ['/dosen']];
                         $items[] =['label' => 'Mahasiswa', 'icon' => 'dashboard', 'url' => ['/mahasiswa']];
                         $items[] =['label' => 'Matakuliah', 'icon' => 'dashboard', 'url' => ['/matakuliah']];
                         $items[] =['label' => 'Kelas', 'icon' => 'dashboard', 'url' => ['/kelas']];
                         $items[] =['label' => 'Jurusan', 'icon' => 'dashboard', 'url' => ['/jurusan']];
                         $items[] =['label' => 'Ruangan', 'icon' => 'dashboard', 'url' => ['/ruangan']];
                         $items[] =['label' => 'Role', 'icon' => 'dashboard', 'url' => ['/role']];
                         $items[] =['label' => 'User', 'icon' => 'dashboard', 'url' => ['/user']];
                    }
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items,
                    

                   

                      
            ]
        ) ?>

    </section>

</aside>
