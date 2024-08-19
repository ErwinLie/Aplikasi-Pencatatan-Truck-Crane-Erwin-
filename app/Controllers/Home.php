<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pencatatan;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
date_default_timezone_set('Asia/Jakarta');

class Home extends BaseController
{
	public function dashboard()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('tb_user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$this->log_activity('User membuka Dashboard');
		echo view('header',$data);
		echo view('menu',$data);
		echo view('dashboard');
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

	public function login()
	{
		$model=new M_pencatatan;
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$this->log_activity('User ke Halaman Login');
		echo view('header',$data);
		echo view('login',$data);
	}

	public function aksilogin()
    {
        $u = $this->request->getPost('username');
        $p = $this->request->getPost('password');
        $captchaAnswer = $this->request->getPost('captcha_answer');

		$this->log_activity('User melakukan Login');

        $model = new M_pencatatan();
        $where = array(
            'username' => $u,
            'password' => md5($p)
        );

        $cek = $model->getWhere('tb_user', $where);

        // Offline CAPTCHA answer (should match the one generated in the view)
        if (!$this->isOnline() && !empty($captchaAnswer)) {
            $correctAnswer = $this->request->getPost('correct_captcha_answer');
            if ($captchaAnswer != $correctAnswer) {
                return redirect()->to('Home/login')->with('error', 'Incorrect offline CAPTCHA.');
            }
        }

        if ($cek > 0) {
            // Handle sessions as usual
            session()->set('id_user', $cek->id_user);
            session()->set('id_level', $cek->id_level);
            session()->set('email', $cek->email);
            session()->set('username', $cek->username);

            // Redirect to the dashboard
            return redirect()->to('Home/dashboard');
        } else {
            return redirect()->to('Home/login')->with('error', 'Invalid username or password.');
        }
    }

    // Function to check if the client is online
    private function isOnline()
    {
        // A simple method to check if the client is online (can be more sophisticated)
        return @fopen("http://www.google.com:80/", "r");
    }


	public function logout()
	{
		$this->log_activity('User Melakukan Log Out');
		session()->destroy();
		return redirect()->to('Home/login');
	}

	public function signup()
	{
		$this->log_activity('User Sign Up');
		echo view ('header');
		echo view ('signup');
		
	}

    public function aksi_sign()
	{
		$model = new M_pencatatan();
		
		$b= $this->request->getPost('username');
		$c= $this->request->getPost('password');
		$d= $this->request->getPost('email');

		$this->log_activity('User melakukan Sign Up');

		// $uploadedFile = $this->request->getFile('foto');
		// $foto = $uploadedFile->getName();

		$isi = array(
			
			'username' => $b,
			'password' => md5($c),
			'email' => $d,
			'id_level' => 2
				);

		$model->tambah('tb_user', $isi);
	 	

		return redirect()->to('Home/login');
		
	}

	public function setting()
	{
		if(session()->get('id_level') == '1'){
			$model=new M_pencatatan;
			$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$this->log_activity('User ke Halaman Setting');
		echo view('header',$data);
		echo view('menu',$data);
		echo view('setting',$data);
		echo view('footer');
		// print_r($data);
	}else{
		return redirect()->to('home/error404');
	}
	}

	public function aksi_e_setting()
{
    $model = new M_pencatatan();
    $a = $this->request->getPost('nama_web');
    $icon = $this->request->getFile('logo_tab');
    $dash = $this->request->getFile('logo_dashboard');
    $login = $this->request->getFile('logo_login');

	$this->log_activity('User melakukan Setting');

    // Debugging: Log received data
    log_message('debug', 'Website Name: ' . $a);
    log_message('debug', 'Tab Icon: ' . ($icon ? $icon->getName() : 'None'));
    log_message('debug', 'Dashboard Icon: ' . ($dash ? $dash->getName() : 'None'));
    log_message('debug', 'Login Icon: ' . ($login ? $login->getName() : 'None'));

    $data = ['nama_web' => $a];

    if ($icon && $icon->isValid() && !$icon->hasMoved()) {
        $icon->move(ROOTPATH . 'public/images/img/', $icon->getName());
        $data['logo_tab'] = $icon->getName();
    }

    if ($dash && $dash->isValid() && !$dash->hasMoved()) {
        $dash->move(ROOTPATH . 'public/images/img/', $dash->getName());
        $data['logo_dashboard'] = $dash->getName();
    }

    if ($login && $login->isValid() && !$login->hasMoved()) {
        $login->move(ROOTPATH . 'public/images/img/', $login->getName());
        $data['logo_login'] = $login->getName();
    }

    $where = ['id_setting' => 1];
    $model->edit('tb_setting', $data, $where);

    return redirect()->to('home/setting');
}

	public function error404()
	{
		if(session()->get('id_level')> '1'){
			$model=new M_pencatatan;
			$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);

		$this->log_activity('User mencoba Ke Halaman yang Dilarang');
	
		echo view('header',$data);
		echo view('error404');
		echo view('footer');
	}else{
		return redirect()->to('home/error404');
	}
	}

	public function pencatatan()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();
		$this->log_activity('User Membuka Pencatatan Pemasukan');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
        $where = ['id_user' => session()->get('id_user')];
        // $data['erwin'] = $model->joinThreePencatatan('tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir', 
		// 'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane', 
		// 'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir', $where);

        $data['erwin'] = $model->join3tblPencatatan(
            'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir', 
		    'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane', 
		    'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir',
            'no_invoice',
            'DESC'
        );

        // Fetch data for dropdowns
        $data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['pelanggans'] = $model->getAll('tb_pencatatan_truck_crane');

        echo view('header', $data);
        echo view('menu', $data);
        echo view('pencatatan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function restore_pencatatan()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();
		$this->log_activity('User Membuka Restore Pencatatan Pemasukan');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
        $where = ['id_user' => session()->get('id_user')];
        // $data['erwin'] = $model->joinThreePencatatan('tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir', 
		// 'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane', 
		// 'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir', $where);

        $data['erwin'] = $model->join3tblPencatatan2(
            'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir', 
		    'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane', 
		    'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir',
            'no_invoice',
            'DESC'
        );

        // Fetch data for dropdowns
        $data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['pelanggans'] = $model->getAll('tb_pencatatan_truck_crane');

        echo view('header', $data);
        echo view('menu', $data);
        echo view('restore_pencatatan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function restore_edit_pencatatan()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();
		$this->log_activity('User Membuka Restore Edit Pencatatan Pemasukan');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
        $where = ['id_user' => session()->get('id_user')];
        $data['erwin'] = $model->joinThreePencatatan('tb_pencatatan_truck_crane_backup', 'tb_truck_crane', 'tb_supir', 
		'tb_pencatatan_truck_crane_backup.id_truck_crane = tb_truck_crane.id_truck_crane', 
		'tb_pencatatan_truck_crane_backup.id_supir = tb_supir.id_supir', $where);

        // Fetch data for dropdowns
        $data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['pelanggans'] = $model->getAll('tb_pencatatan_truck_crane');

        echo view('header', $data);
        echo view('menu', $data);
        echo view('restore_edit_pencatatan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

	public function filter_pencatatan_by_status()
{
    // Mengambil data dari form
	$this->log_activity('User mencari Data Pencatatan Pemasukan');

    $status = $this->request->getPost('status');
    $awal = $this->request->getPost('awal2');
    $akhir = $this->request->getPost('akhir2');
    $truck_crane_id = $this->request->getPost('truck_crane');
    $supir_id = $this->request->getPost('supir');
    $pelanggan_id = $this->request->getPost('pelanggan');

	$status = $status === 'Pilih' ? null : $status;
    $awal = $awal === 'Pilih' ? null : $awal;
    $akhir = $akhir === 'Pilih' ? null : $akhir;
    $truck_crane_id = $truck_crane_id === 'Pilih' ? null : $truck_crane_id;
    $supir_id = $supir_id === 'Pilih' ? null : $supir_id;
    $pelanggan_id = $pelanggan_id === 'Pilih' ? null : $pelanggan_id;

    // Memuat model
    $model = new M_pencatatan(); // Ganti 'YourModel' dengan nama model Anda
	$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
	$data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['pelanggans'] = $model->getAll('tb_pencatatan_truck_crane');
    // Mendapatkan data yang difilter
    $data['erwin'] = $model->filterByCriteria(
        'tb_pencatatan_truck_crane',
        'tb_truck_crane',
        'tb_supir',
        'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane',
        'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir',
        !empty($status) ? $status : null,
        !empty($awal) ? $awal : null,
        !empty($akhir) ? $akhir : null,
        !empty($truck_crane_id) ? $truck_crane_id : null,
        !empty($supir_id) ? $supir_id : null,
        !empty($pelanggan_id) ? $pelanggan_id : null
    );

    // Kirim data ke view atau ke format JSON jika menggunakan AJAX
    echo view('header', $data);
            echo view('menu', $data);
            echo view('pencatatan', $data);
            echo view('footer');
	// print_r($status);
	// print_r($awal);
	// print_r($akhir);
	// print_r($truck_crane_id);
	// print_r($supir_id);
	// print_r($pelanggan_id);
}

    public function aksi_e_pencatatan()
	{
		$model = new M_pencatatan();

		$this->log_activity('User melakukan Edit Pencatatan Pemasukan');

		$a = $this->request->getPost('truck_crane');
		$b = $this->request->getPost('supir');
		$c = $this->request->getPost('pelanggan');
		$d = $this->request->getPost('pekerjaan');
		$e = $this->request->getPost('lokasi');
		$f = $this->request->getPost('tanggal');
		$g = $this->request->getPost('total_jam');
		$h = $this->request->getPost('harga');
		$i = $this->request->getPost('status');
		$j = $this->request->getPost('no_invoice');
		$id_pencatatan = $this->request->getPost('id_pencatatan');
		$id_user = session()->get('id_user');
		$where = array('id_pencatatan'=>$id_pencatatan);


        $oldData = $model->getWhere('tb_pencatatan_truck_crane', ['id_pencatatan' => $id_pencatatan]);

        // Simpan data lama ke tabel backup
        if ($oldData) {
            $backupData = [
                'id_pencatatan' => $oldData->id_pencatatan,  // integer
                'id_truck_crane' => $oldData->id_truck_crane,  // integer
                'id_supir' => $oldData->id_supir,             // integer
                'pelanggan' => $oldData->pelanggan,     // integer
                'pekerjaan' => $oldData->pekerjaan, // integer
                'lokasi' => $oldData->lokasi,               // enum
                'tanggal' => $oldData->tanggal,                 // varchar(255)
                'total_jam' => $oldData->total_jam,
                'harga' => $oldData->harga,
                'status' => $oldData->status,
                'no_invoice' => $oldData->no_invoice,                    // integer
                'create_by' => $oldData->create_by,         // integer
                'update_by' => $oldData->update_by,         // integer
                'create_at' => $oldData->create_at,         // datetime
                'update_at' => $oldData->update_at,         // datetime
                'backup_at' => date('Y-m-d H:i:s'),         // datetime (current time)
                'backup_by' => $id_user,                   // integer (user who made the backup)
                // 'kode_pemesanan' => $oldData->kode_pemesanan,
            ];

            // Debug: cek hasil insert ke tabel backup
            if ($model->saveToBackup('tb_pencatatan_truck_crane_backup', $backupData)) {
                echo "Data backup berhasil disimpan!";
            } else {
                echo "Gagal menyimpan data ke backup.";
            }
        } else {
            echo "Data lama tidak ditemukan.";
        }


		$isi = array(

					'id_truck_crane' => $a,
					'id_supir' => $b,
					'pelanggan' => $c,
					'pekerjaan' => $d,
					'lokasi' => $e,
					'tanggal' => $f,
					'total_jam' => $g,
					'harga' => $h,
					'status' => $i,
					'no_invoice' => $j
		);

		$model->edit('tb_pencatatan_truck_crane', $isi, $where);
		//  print_r($isi);
		return redirect()->to('home/pencatatan');

	}

    public function restore_data_edit_pencatatan($backup_id)
{
    $model = new M_pencatatan();

    // Ambil data backup berdasarkan ID
    $backupData = $model->db->table('tb_pencatatan_truck_crane_backup')->where('id_pencatatan', $backup_id)->get()->getRow();

    if ($backupData) {
        // Update data di tabel pemesanan dengan data backup
        $data = [
            'id_truck_crane' => $backupData->id_truck_crane,
            'id_supir' => $backupData->id_supir,
            'pelanggan' => $backupData->pelanggan,
            'pekerjaan' => $backupData->pekerjaan,
            'lokasi' => $backupData->lokasi,
            'tanggal' => $backupData->tanggal,
            'total_jam' => $backupData->total_jam,
            'harga' => $backupData->harga,
            'status' => $backupData->status,
            'no_invoice' => $backupData->no_invoice,
            'update_by' => $backupData->backup_by,
            'update_at' => $backupData->backup_at,
        ];
        
        // Update tabel utama dengan data dari backup
        $model->db->table('tb_pencatatan_truck_crane')->where('id_pencatatan', $backup_id)->update($data);
        
        // Hapus data backup setelah restore
        $model->db->table('tb_pencatatan_truck_crane_backup')->where('id_pencatatan', $backup_id)->delete();

        // Log aktivitas restore
        $this->log_activity('User Restore Data Pencatatan Pemasukan');

        return redirect()->to('home/pencatatan')->with('message', 'Data berhasil dipulihkan dari backup.');
    }

    return redirect()->to('home/pencatatan')->with('error', 'Gagal memulihkan data.');
}


	public function hapus_pencatatan($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Hapus Data Pencatatan Pemasukan');
		$where = array('id_pencatatan'=>$id);
        $isi = array(

            'delete_at' => date('Y-m-d H:i:s'),
);
		$model->edit('tb_pencatatan_truck_crane',$isi,$where);
		
		return redirect()->to('Home/pencatatan');
	}

    public function hapus_restore_pencatatan($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Hapus Data Pencatatan Pemasukan');
		$where = array('id_pencatatan'=>$id);
        $isi = array(

            'delete_at' => NULL,
);
		$model->edit('tb_pencatatan_truck_crane', $isi,$where);
		
		return redirect()->to('Home/pencatatan');
	}

	public function t_pencatatan()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User ke Form Tambah Pencatatan Pemasukan');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
		$data['erwin'] = $model->joinThreeTables('tb_pencatatan_truck_crane',
		'tb_truck_crane',
		'tb_supir',
		'tb_pencatatan_truck_crane.id_truck_crane = tb_truck_crane.id_truck_crane',
		'tb_pencatatan_truck_crane.id_supir = tb_supir.id_supir');

		$data['t'] = $model->tampil('tb_truck_crane', 'id_truck_crane');
        $data['s'] = $model->tampil('tb_supir', 'id_supir');

		echo view ('header' ,$data);
		echo view('menu',$data);
		echo view('t_pencatatan' ,$data);
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_t_pencatatan()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penambahan Data Pencatatan Pemasukan');
		$a = $this->request->getPost('no_invoice');
		$b = $this->request->getPost('truck_crane');
		$c = $this->request->getPost('supir');
		$d = $this->request->getPost('pelanggan');
		$e = $this->request->getPost('pekerjaan');
		$f = $this->request->getPost('lokasi');
		$g = $this->request->getPost('tanggal');
		$h = $this->request->getPost('total_jam');
		$i = $this->request->getPost('harga');
		$j = $this->request->getPost('status');
		
		$isi = array(

					'no_invoice' => $a,
					'id_truck_crane' => $b,
					'id_supir' => $c,
					'pelanggan' => $d,
					'pekerjaan' => $e,
					'lokasi' => $f,
					'tanggal' => $g,
					'total_jam' => $h,
					'harga' => $i,
					'status' => $j
					
		);
		
		$model->tambah('tb_pencatatan_truck_crane', $isi);
		return redirect()->to('Home/pencatatan');

	}


	public function pencatatan_pengeluaran()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
		$this->log_activity('User membuka Pencatatan Pengeluaran');
        // $data['erwin']=$model->joinFourPengeluaran('tb_pencatatan_pengeluaran_tc','tb_truck_crane','tb_supir','tb_kategori',
		// 'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
		// 'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		// 'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori', $where);

        $data['erwin'] = $model->join4tblPengeluaran(
            'tb_pencatatan_pengeluaran_tc','tb_truck_crane','tb_supir','tb_kategori',
		'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
		'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori',
           'id_pengeluaran_tc',
            'DESC' 

        );

		$data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['kategoris'] = $model->getAll('tb_kategori');

		echo view('header',$data);
		echo view('menu',$data);
		echo view('pencatatan_pengeluaran',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

    public function restore_pengeluaran()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
		$this->log_activity('User membuka Pencatatan Pengeluaran');
        // $data['erwin']=$model->joinFourPengeluaran('tb_pencatatan_pengeluaran_tc','tb_truck_crane','tb_supir','tb_kategori',
		// 'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
		// 'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		// 'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori', $where);

        $data['erwin'] = $model->join4tblPengeluaran2(
            'tb_pencatatan_pengeluaran_tc','tb_truck_crane','tb_supir','tb_kategori',
		'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
		'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori',
           'id_pengeluaran_tc',
            'DESC' 

        );

		$data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['kategoris'] = $model->getAll('tb_kategori');

		echo view('header',$data);
		echo view('menu',$data);
		echo view('restore_pengeluaran',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

    public function hapus_pengeluaran($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penghapusan Data Pencatatan Pengeluaran');
		$where = array('id_pengeluaran_tc'=>$id);
        $isi = array(

            'delete_at' => date('Y-m-d H:i:s'),
);

		$model->hapus('tb_pencatatan_pengeluaran_tc',$where);
		
		return redirect()->to('Home/pencatatan_pengeluaran');
	}


    public function hapus_restore_pengeluaran($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Hapus Restore Data Pencatatan Pengeluaran');
		$where = array('id_pengeluaran_tc'=>$id);
        $isi = array(

            'delete_at' => NULL,
);
		$model->edit('tb_pencatatan_pengeluaran_tc', $isi,$where);
		
		return redirect()->to('Home/pencatatan_pengeluaran');
	}

	public function filter_pencatatan_pengeluaran()
{
    // Mengambil data dari form
	$this->log_activity('User melakukan Pencarian Data Pencatatan Pengeluaran');

    $kategori_id = $this->request->getPost('kategori');
    $awal = $this->request->getPost('awal2');
    $akhir = $this->request->getPost('akhir2');
    $truck_crane_id = $this->request->getPost('truck_crane');
    $supir_id = $this->request->getPost('supir');
    // $pelanggan_id = $this->request->getPost('pelanggan');

	$kategori_id = $kategori_id === 'Pilih' ? null : $kategori_id;
    $awal = $awal === 'Pilih' ? null : $awal;
    $akhir = $akhir === 'Pilih' ? null : $akhir;
    $truck_crane_id = $truck_crane_id === 'Pilih' ? null : $truck_crane_id;
    $supir_id = $supir_id === 'Pilih' ? null : $supir_id;
    // $pelanggan_id = $pelanggan_id === 'Pilih' ? null : $pelanggan_id;

    // Memuat model
    $model = new M_pencatatan(); // Ganti 'YourModel' dengan nama model Anda
	$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
	$data['truck_cranes'] = $model->getAll('tb_truck_crane');
        $data['supirs'] = $model->getAll('tb_supir');
        $data['kategoris'] = $model->getAll('tb_kategori');
    // Mendapatkan data yang difilter
    $data['erwin'] = $model->filterByCriteriaPengeluaran(
        'tb_pencatatan_pengeluaran_tc',
        'tb_truck_crane',
        'tb_supir',
		'tb_kategori',
        'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
        'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori',
        !empty($kategori_id) ? $kategori_id : null,
        !empty($awal) ? $awal : null,
        !empty($akhir) ? $akhir : null,
        !empty($truck_crane_id) ? $truck_crane_id : null,
        !empty($supir_id) ? $supir_id : null,
        // !empty($pelanggan_id) ? $pelanggan_id : null
    );
    // Kirim data ke view atau ke format JSON jika menggunakan AJAX
    		echo view('header' ,$data);
            echo view('menu', $data);
            echo view('pencatatan_pengeluaran', $data);
            echo view('footer');	
}

	public function t_pencatatan_pengeluaran()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Form Tambah Pencatatan Pengeluaran');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
		$data['erwin'] = $model->joinFourTables('tb_pencatatan_pengeluaran_tc',
		'tb_truck_crane',
		'tb_supir',
		'tb_kategori',
		'tb_pencatatan_pengeluaran_tc.id_truck_crane = tb_truck_crane.id_truck_crane',
		'tb_pencatatan_pengeluaran_tc.id_supir = tb_supir.id_supir',
		'tb_pencatatan_pengeluaran_tc.id_kategori = tb_kategori.id_kategori');

		$data['t'] = $model->tampil('tb_truck_crane', 'id_truck_crane');
        $data['s'] = $model->tampil('tb_supir', 'id_supir');
		$data['k'] = $model->tampil('tb_kategori', 'id_kategori');

		echo view ('header', $data);
		echo view('menu', $data);
		echo view('t_pencatatan_pengeluaran' ,$data);
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_t_pencatatan_pengeluaran()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penambahan Data Pencatatan Pengeluaran');

		$a = $this->request->getPost('supir');
		$b = $this->request->getPost('truck_crane');
		$c = $this->request->getPost('tanggal');
		$d = $this->request->getPost('deskripsi');
		$e = $this->request->getPost('harga');
		$f = $this->request->getPost('kategori');
		
		$isi = array(

					'id_supir' => $a,
					'id_truck_crane' => $b,
					'tanggal' => $c,
					'deskripsi' => $d,
					'harga' => $e,
					'id_kategori' => $f,
					
					
		);
		
		$model->tambah('tb_pencatatan_pengeluaran_tc', $isi);
		return redirect()->to('Home/pencatatan_pengeluaran');

	}

	// public function aksi_e_pengeluaran()
// {
//     $model = new M_pencatatan();
//     $this->log_activity('User melakukan Pengeditan Data Pencatatan Pengeluaran');

//     $data = [
//         'id_supir' => $this->request->getPost('supir'),
//         'id_truck_crane' => $this->request->getPost('truck_crane'),
//         'tanggal' => $this->request->getPost('tanggal'),
//         'deskripsi' => $this->request->getPost('deskripsi'),
//         'harga' => $this->request->getPost('harga'),
//         'id_kategori' => $this->request->getPost('kategori'),
//     ];
//     $id_pengeluaran_tc = $this->request->getPost('id_pengeluaran_tc');

//     $model->edit('tb_pencatatan_pengeluaran_tc', $data, ['id_pengeluaran_tc' => $id_pengeluaran_tc]);

//     return redirect()->to('home/pencatatan_pengeluaran');
// }


public function aksi_e_pengeluaran()
	{
		$model = new M_pencatatan();

		$this->log_activity('User melakukan Edit Pencatatan Pengeluaran');

		$a = $this->request->getPost('supir');
		$b = $this->request->getPost('truck_crane');
		$c = $this->request->getPost('tanggal');
		$d = $this->request->getPost('deskripsi');
		$e = $this->request->getPost('harga');
		$f = $this->request->getPost('kategori');
		$id_pengeluaran_tc = $this->request->getPost('id_pengeluaran_tc');
		
		$where = array('id_pengeluaran_tc'=>$id_pengeluaran_tc);

		$isi = array(

					'id_supir' => $a,
					'id_truck_crane' => $b,
					'tanggal' => $c,
					'deskripsi' => $d,
					'harga' => $e,
					'id_kategori' => $f
		);

		$model->edit('tb_pencatatan_pengeluaran_tc', $isi, $where);
		//  print_r($isi);
		return redirect()->to('home/pencatatan_pengeluaran');

	}


	

	public function supir()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Halaman Login');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
        $data['erwin']=$model->tampil2('tb_supir');
		echo view('header' ,$data);
		echo view('menu',$data);
		echo view('supir',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

	public function t_supir()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Form Tambah Supir');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);

		echo view ('header',$data);
		echo view('menu',$data);
		echo view('t_supir');
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	// public function aksi_t_supir()
	// {
	// 	$model = new M_pencatatan();
	// 	$a = $this->request->getPost('nama');
	// 	$b = $this->request->getPost('no_hp');
	// 	$c = $this->request->getPost('alamat');
	// 	$d = $this->request->getPost('nik');
		
	// 	$isi = array(

	// 				'nama' => $a,
	// 				'no_hp' => $b,
	// 				'alamat' => $c,
	// 				'nik' => $d
					
	// 	);
		
	// 	$model->tambah('tb_supir', $isi);
	// 	return redirect()->to('Home/supir');

	// }

	public function aksi_t_supir()
    {
        $model = new M_pencatatan();
		$this->log_activity('User melakukan Tambah Data Supir');
        $nik = $this->request->getPost('nik');

        // Cek apakah NIK sudah ada di database
        $existingSupir = $model->getWhere('tb_supir', ['nik' => $nik]);

        if ($existingSupir) {
            // Jika NIK sudah ada, jangan tambahkan data dan beri notifikasi
            return redirect()->to('Home/t_supir')->with('error', 'NIK sudah ada, data tidak dapat ditambahkan.');
        } else {
            // Jika NIK belum ada, tambahkan data baru
            $a = $this->request->getPost('nama');
            $b = $this->request->getPost('no_hp');
            $c = $this->request->getPost('alamat');
            
            $isi = array(
                'nama' => $a,
                'no_hp' => $b,
                'alamat' => $c,
                'nik' => $nik
            );
            
            $model->tambah('tb_supir', $isi);
            return redirect()->to('Home/supir')->with('success', 'Data supir berhasil ditambahkan.');
        }
    }

	public function aksi_e_supir()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Pengeditan Data Supir');
		$a = $this->request->getPost('nama');
		$b = $this->request->getPost('nik');
		$c = $this->request->getPost('no_hp');
		$d = $this->request->getPost('alamat');
		$id_supir = $this->request->getPost('id_supir');
		
		$where = array('id_supir'=>$id_supir);

		$isi = array(

					'nama' => $a,
					'nik' => $b,
					'no_hp' => $c,
					'alamat' => $d,
		);

		$model->edit('tb_supir', $isi, $where);
		//  print_r($isi);
		return redirect()->to('home/supir');

	}

	public function hapus_supir($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penghapusan Data Supir');
		$where = array('id_supir'=>$id);
		$model->hapus('tb_supir',$where);
		
		return redirect()->to('Home/supir');
	}

	public function truck_crane()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka view Truk Crane');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
        $data['erwin']=$model->tampil3('tb_truck_crane');
		echo view('header',$data);
		echo view('menu',$data);
		echo view('truck_crane',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

	public function t_truck_crane()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Form Tambah Data Truk Crane');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);

		echo view ('header',$data);
		echo view('menu',$data);
		echo view('t_truck_crane');
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_t_truck_crane()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penambahan Data Truk Crane');
		$a = $this->request->getPost('merk_truck');
		$b = $this->request->getPost('tipe_truck');
		$c = $this->request->getPost('plat_truck');
		$d = $this->request->getPost('tahun_truck');
		$e = $this->request->getPost('merk_crane');
		$f = $this->request->getPost('tipe_crane');
		$g = $this->request->getPost('kapasitas_crane');
		$h = $this->request->getPost('bobot_truck_crane');
		
		$isi = array(

					'merk_truck' => $a,
					'tipe_truck' => $b,
					'plat_truck' => $c,
					'tahun_truck' => $d,
					'merk_crane' => $e,
					'tipe_crane' => $f,
					'kapasitas_crane' => $g,
					'bobot_truck_crane' => $h
					
		);
		
		$model->tambah('tb_truck_crane', $isi);
		return redirect()->to('Home/truck_crane');

	}

	public function aksi_e_truck_crane()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Pengeditan Data Truk Crane');
		$a = $this->request->getPost('merk_truck');
		$b = $this->request->getPost('tipe_truck');
		$c = $this->request->getPost('plat_truck');
		$d = $this->request->getPost('tahun_truck');
		$e = $this->request->getPost('merk_crane');
		$f = $this->request->getPost('tipe_crane');
		$g = $this->request->getPost('kapasitas_crane');
		$h = $this->request->getPost('bobot_truck_crane');
		$id = $this->request->getPost('id');
		
		$where = array('id_truck_crane'=>$id);

		$isi = array(

					'merk_truck' => $a,
					'tipe_truck' => $b,
					'plat_truck' => $c,
					'tahun_truck' => $d,
					'merk_crane' => $e,
					'tipe_crane' => $f,
					'kapasitas_crane' => $g,
					'bobot_truck_crane' => $h
		);

		$model->edit('tb_truck_crane', $isi, $where);
		//  print_r($isi);
		return redirect()->to('home/truck_crane');

	}

	public function hapus_truck_crane($id){
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penghapusan Data Truk Crane');
		$where = array('id_truck_crane'=>$id);
		$model->hapus('tb_truck_crane',$where);
		
		return redirect()->to('Home/truck_crane');
	}

	public function user()
	{
		// if (session()->get('id_level')>0) {
			if(session()->get('id_level') == '1'){
		$model = new M_pencatatan();
		$this->log_activity('User membuka view User');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
        $data['erwin']=$model->tampil('tb_user');
		echo view('header',$data);
		echo view('menu',$data);
		echo view('user',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/error404');
		}
	}

	public function resetpassword($id){
		$model = new M_pencatatan;
		$this->log_activity('User melakukan Reset Password');
		$where = array('id_user' =>$id );
		$table = 'tb_user'; // Nama tabel
		$kolom = 'id_user';
		$data = array(
		   
			'password' => md5('ds123'),
		);
	
		$model->resetpassword($table, $kolom, $where, $data);
		return redirect()->to('Home/user');
	}

	public function t_user()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Form Penambahan Data User');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		echo view ('header',$data);
		echo view('menu',$data);
		echo view('t_user');
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_t_user()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penambahan Data User');
		$a = $this->request->getPost('username');
		$b = $this->request->getPost('password');
		$c = $this->request->getPost('email');
		$d = $this->request->getPost('level');
		
		$isi = array(

					'username' => $a,
					'password' =>md5 ($b),
					'email' => $c,
					'id_level' => $d
					
		);
		
		$model->tambah('tb_user', $isi);
		return redirect()->to('Home/user');

	}

	public function aksi_e_user()
{
    $model = new M_pencatatan();
	$this->log_activity('User melakukan Pengeditan Data User');
    $id_user = $this->request->getPost('id_user');
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $id_level = $this->request->getPost('id_level');

    $where = array('id_user' => $id_user);
    $data = array(
        'username' => $username,
        'email' => $email,
        'id_level' => $id_level
    );

    $model->edit('tb_user', $data, $where);
    return redirect()->to('Home/user');
}

public function hapus_user($id){
	$model = new M_pencatatan();
	$this->log_activity('User melakukan Penghapusan Data User');
	$where = array('id_user'=>$id);
	$model->hapus('tb_user',$where);
	
	return redirect()->to('Home/user');
}

public function profile()
    {
        if (session()->get('id_level') > 0) {
            $model = new M_pencatatan();
            
            $this->log_activity('Masuk ke profile');
            $where = array('id_user' => session()->get('id_user'));
            $data['darren'] = $model->getwhere('tb_user', $where);
            $where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);

            echo view('header', $data);
            echo view('menu', $data);
            echo view('profile', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function editfoto()
{
    $model = new M_pencatatan(); // Make sure this model handles updates to tb_user
    $this->log_activity('Mengedit Foto');
    
    // Get current user data
    $userId = session()->get('id_user'); // Correct the session key
    $userData = $model->getById($userId); // Ensure this retrieves the correct user data

    // Check if a file was uploaded
    if ($file = $this->request->getFile('foto')) {
        if ($file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/images/img/', $newFileName); // Save file to the file system
            
            // If the user already has a profile photo, delete the old one
            if ($userData->foto && file_exists(ROOTPATH . 'public/images/img/' . $userData->foto)) {
                unlink(ROOTPATH . 'public/images/img/' . $userData->foto);
            }
            
            // Update the database with the new file name
            $userDataUpdate = ['foto' => $newFileName];
            $model->edit('tb_user', $userDataUpdate, ['id_user' => $userId]);
        }
    }

    return redirect()->to('home/profile');
}


    public function aksi_e_profile()
    {
        if (session()->get('id_level') > 0) {
            $model = new M_pencatatan();
            $this->log_activity('Mengedit Profile');
            $yoga = $this->request->getPost('username');
            $yoga1 = $this->request->getPost('email');
            $id = $this->request->getPost('id');

            $where = array('id_user' => $id); // Jika id_user adalah kunci utama untuk menentukan record


            $isi = array(
                'username' => $yoga,
                'email' => $yoga1,
            );

            $model->edit('tb_user', $isi, $where);
            return redirect()->to('home/profile');
            // print_r($yoga);
            // print_r($id);
        } else {
            return redirect()->to('home/login');
        }
    }
    public function changepassword()
    {
        if (session()->get('id_level') > 0) {

            $model = new M_pencatatan();
            $this->log_activity('Mengubah Password');
    
            $where = array('id_user' => session()->get('id'));
            $data['darren'] = $model->getwhere('tb_user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('changepassword', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_changepass()
    {
        $model = new M_pencatatan();
        $oldPassword = $this->request->getPost('old');
        $newPassword = $this->request->getPost('new');
        $userId = session()->get('id_level');

        // Dapatkan password lama dari database
        $currentPassword = $model->getPassword($userId);

        // Verifikasi apakah password lama cocok
        if (md5($oldPassword) !== $currentPassword) {
            // Set pesan error jika password lama salah
            session()->setFlashdata('error', 'Password lama tidak valid.');
            return redirect()->back()->withInput();
        }

        // Update password baru
        $data = [
            'password' => md5($newPassword),
            'update_by' => $userId,
            'update_at' => date('Y-m-d H:i:s')
        ];
        $where = ['id_user' => $userId];

        $model->edit('tb_user', $data, $where);

        // Set pesan sukses
        session()->setFlashdata('success', 'Password berhasil diperbarui.');
        return redirect()->to('home/changepassword');
    }

	public function kategori()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka view Kategori');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);
		$where=array('id_user'=>session()->get('id_user'));
        $data['erwin']=$model->tampil4('tb_kategori');
		echo view('header',$data);
		echo view('menu',$data);
		echo view('kategori',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
	}

	public function t_kategori()
	{
		if (session()->get('id_level')>0) {
		$model = new M_pencatatan();
		$this->log_activity('User membuka Form Tambah Kategori');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getWhere('tb_setting',$where);

		echo view ('header',$data);
		echo view('menu',$data);
		echo view('t_kategori');
		echo view('footer');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_t_kategori()
	{
		$model = new M_pencatatan();
		$this->log_activity('User melakukan Penambahan Data Kategori');
		$a = $this->request->getPost('kategori');
		
		$isi = array(

					'kategori' => $a
					
		);
		
		$model->tambah('tb_kategori', $isi);
		return redirect()->to('Home/kategori');

	}

	public function aksi_e_kategori()
{
    $model = new M_pencatatan();
	$this->log_activity('User melakukan Pengeditan Data Kategori');
    $id_kategori = $this->request->getPost('id_kategori');
    $kategori = $this->request->getPost('kategori');

    $where = array('id_kategori' => $id_kategori);
    $data = array('kategori' => $kategori);

    $model->edit('tb_kategori', $data, $where);
    return redirect()->to('Home/kategori');
}

public function hapus_kategori($id){
	$model = new M_pencatatan();
	$this->log_activity('User melakukan Penghapusan Data Kategori');
	$where = array('id_kategori'=>$id);
	$model->hapus('tb_kategori',$where);
	
	return redirect()->to('Home/kategori');
}



// public function laporan()
// {
//     if (session()->get('id_level') > 0) {
//         $model = new M_pencatatan();
//         $this->log_activity('User membuka view Laporan');
        
//         // Retrieve settings and categories for the view
//         $where = array('id_setting' => 1);
//         $data['setting'] = $model->getWhere('tb_setting', $where);
//         $data['kategoris'] = $model->getAll('tb_kategori');

//         // Initialize variables for form inputs
//         $tanggalawal = $this->request->getPost('tanggalawal');
//         $tanggalakhir = $this->request->getPost('tanggalakhir');
//         $status = $this->request->getPost('status');

//         // Perform the filtering if input is provided
//         if ($tanggalawal && $tanggalakhir && $status) {
//             $data['erwin'] = $model->betweenjoin1(
//                 'tb_pencatatan_truck_crane', 
//                 'tb_truck_crane', 
//                 'tb_supir',
//                 'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane', 
//                 'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir', 
//                 $tanggalawal, 
//                 $tanggalakhir,
//                 $status // Pass the status to the model
//             );
//         }

//         // Pass the form inputs back to the view for maintaining form state
//         $data['tanggalawal'] = $tanggalawal;
//         $data['tanggalakhir'] = $tanggalakhir;
//         $data['status'] = $status;

//         // Load the views
//         echo view('header', $data);
//         echo view('menu', $data);
//         echo view('laporan', $data);
//         echo view('footer');
//     } else {
//         return redirect()->to('home/login');
//     }
// }

public function laporan()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();
        $this->log_activity('User membuka view Laporan');
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('tb_setting', $where);
        $data['kategoris'] = $model->getAll('tb_kategori');

        // Panggil fungsi filterByDate
        $data = $this->filterByDate();

        echo view('header', $data);
        echo view('menu', $data);
        echo view('laporan', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function filterByDate()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();

        // Ambil input form
        $tanggalawal = $this->request->getPost('tanggalawal');
        $tanggalakhir = $this->request->getPost('tanggalakhir');
        $status = $this->request->getPost('status');

        // Jika tanggal awal dan tanggal akhir tidak diisi, ambil semua data
        if (!$tanggalawal || !$tanggalakhir) {
            $data['erwin'] = $model->betweenjoin1(
                'tb_pencatatan_truck_crane',
                'tb_truck_crane',
                'tb_supir',
                'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane',
                'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir'
            );
        } else {
            // Ambil data yang telah difilter berdasarkan tanggal dan status
            $data['erwin'] = $model->betweenjoin1(
                'tb_pencatatan_truck_crane',
                'tb_truck_crane',
                'tb_supir',
                'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane',
                'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir',
                $tanggalawal,
                $tanggalakhir,
                $status
            );
        }

        // Kembalikan nilai tanggal dan status ke view
        $data['tanggalawal'] = $tanggalawal;
        $data['tanggalakhir'] = $tanggalakhir;
        $data['status'] = $status;

        return $data;
    } else {
        return redirect()->to('home/login');
    }
}


public function laporan_pengeluaran()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();
        $this->log_activity('User membuka view Laporan Pengeluaran');
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('tb_setting', $where);
        $data['kategoris'] = $model->getAll('tb_kategori');

        // Panggil fungsi filterByDatePengeluaran dan simpan hasilnya ke variabel data
        $filteredData = $this->filterByDatePengeluaran();

        // Gabungkan hasil filter dengan data setting dan kategoris
        $data = array_merge($data, $filteredData);

        echo view('header', $data);
        echo view('menu', $data);
        echo view('laporan_pengeluaran', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/login');
    }
}


public function filterByDatePengeluaran()
{
    if (session()->get('id_level') > 0) {
        $model = new M_pencatatan();

        // Ambil input form
        $tanggalawal = $this->request->getPost('tanggalawal2');
        $tanggalakhir = $this->request->getPost('tanggalakhir2');
        $kategori = $this->request->getPost('kategori2');

        // Jika tanggal awal dan tanggal akhir tidak diisi, ambil semua data
        if (!$tanggalawal || !$tanggalakhir) {
            $data['erwin'] = $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori'
            );
        } else {
            // Ambil data yang telah difilter berdasarkan tanggal dan status
            $data['erwin'] = $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
                $tanggalawal, 
                $tanggalakhir,
                $kategori // Pass the selected category
            );
        }

        // Kembalikan nilai tanggal dan status ke view
        $data['tanggalawal2'] = $tanggalawal;
        $data['tanggalakhir2'] = $tanggalakhir;
        $data['status2'] = $kategori;

        return $data;
    } else {
        return redirect()->to('home/login');
    }
}

public function filter_pengeluaran()
{
    // Load model
    $this->load->model('Pengeluaran_model');

    // Get the filter inputs
    $tanggalawal = $this->input->post('tanggalawal2');
    $tanggalakhir = $this->input->post('tanggalakhir2');
    $kategori = $this->input->post('kategori2');

	$model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
                $tanggalawal, 
                $tanggalakhir,
                $kategori // Pass the selected category
            ),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
        ];

    // Call the model method to filter data
    $data['erwin'] = $this->Pengeluaran_model->get_filtered_pengeluaran($tanggalawal, $tanggalakhir, $kategori);

    // Load the view with the filtered data
    $this->load->view('laporan_pengeluaran', $data);
}

	public function print_pemasukan()
{
    if (session()->get('id_level') > 0) {
        $tanggalawal = $this->request->getpost('tanggalawal');
        $tanggalakhir = $this->request->getpost('tanggalakhir');
        $status = $this->request->getpost('status');

		$this->log_activity('User melakukan Window Print Pencatatan Pemasukan');

        $model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin1(
                'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir',
                'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir', 
                $tanggalawal, 
                $tanggalakhir,
                $status // Pass the status to the model
            ),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
        ];
    
        return view('print_pemasukan', $data);
    } else {
        return redirect()->to('Home/login');
    }
}

public function filter_pemasukan()
{
    // Load model
    $this->load->model('Pemasukan_model');

    // Get the filter inputs
    $tanggalawal = $this->input->post('tanggalawal');
    $tanggalakhir = $this->input->post('tanggalakhir');
    $status = $this->input->post('status');

	$model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin1(
                'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir',
                'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir', 
                $tanggalawal, 
                $tanggalakhir,
                $status // Pass the status to the model
            ),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
        ];

    // Call the model method to filter data
    $data['erwin'] = $this->Pemasukan_model->get_filtered_pemasukan($tanggalawal, $tanggalakhir, $status);

    // Load the view with the filtered data
    $this->load->view('laporan', $data);
}



		// public function print_pengeluaran()
		// {
		// 	if (session()->get('id_level')>0) {
		// 			$tanggalawal = $this->request->getpost('tanggalawal4');
		// 			$tanggalakhir = $this->request->getpost('tanggalakhir4');
			
		// 			$model = new M_pencatatan();
		// 			$data = [
		// 				'erwin' => $model->betweenjoin2(
		// 					'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
		// 					'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
		// 					'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
		// 					'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
		// 					$tanggalawal, 
		// 					$tanggalakhir
		// 				),
		// 				'tanggalawal4' => $tanggalawal,
		// 				'tanggalakhir4' => $tanggalakhir,
		// 			];
				
		// 		// return view('print_pengeluaran', $data);
		// 			print_r($data);
		// 	} else {
		// 		// return redirect()->to('Home/login');
		// 	}
		// }

// 		public function print_pengeluaran()
// {
//     if (session()->get('id_level') > 0) {
//         $tanggalawal = $this->request->getPost('tanggalawal4');
//         $tanggalakhir = $this->request->getPost('tanggalakhir4');
        
//         // Pernyataan debugging
//         log_message('info', "Tanggal Awal: $tanggalawal, Tanggal Akhir: $tanggalakhir");

//         $model = new M_pencatatan();
//         $data = [
//             'erwin' => $model->betweenjoin2(
//                 'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
//                 'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
//                 'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
//                 'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
//                 $tanggalawal, 
//                 $tanggalakhir
//             ),
//             'tanggalawal4' => $tanggalawal,
//             'tanggalakhir4' => $tanggalakhir,
//         ];

//         return view('print_pengeluaran', $data);
//     } else {
//         return redirect()->to('Home/login');
//     }
// }

public function print_pengeluaran()
{
    if (session()->get('id_level') > 0) {
        $tanggalawal = $this->request->getPost('tanggalawal2');
        $tanggalakhir = $this->request->getPost('tanggalakhir2');
        $kategori = $this->request->getPost('kategori2');

		$this->log_activity('User melakukan Window Print Pencatatan Pengeluaran');

        $model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
                $tanggalawal, 
                $tanggalakhir,
                $kategori // Pass the selected category
            ),
            'tanggalawal2' => $tanggalawal,
            'tanggalakhir2' => $tanggalakhir,
        ];

        return view('print_pengeluaran', $data);
    } else {
        return redirect()->to('Home/login');
    }
}


public function print_pemasukan_pdf()
{
    if (session()->get('id_level') > 0) {
        $tanggalawal = $this->request->getPost('tanggalawal');
        $tanggalakhir = $this->request->getPost('tanggalakhir');
        $status = $this->request->getPost('status');

		$this->log_activity('User melakukan Print Pencatatan Pemasukan PDF');

        $model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin1(
                'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir',
                'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane',
                'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir',
                $tanggalawal,
                $tanggalakhir,
                $status // Pass the status to the model
            ),
            'tanggalawal' => $tanggalawal,
            'tanggalakhir' => $tanggalakhir,
        ];

        // Load view content for PDF generation
        $html = view('print_pemasukan_pdf', $data);
        require_once(ROOTPATH . 'Vendor/autoload.php');

        // Load TCPDF library with landscape orientation
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); // 'L' for landscape
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name'); // Change to your name
        $pdf->SetTitle('Laporan Pemasukan Truck Crane');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set default header and footer data
        $pdf->setHeaderData('', 0, 'Laporan Pemasukan Truck Crane', 'Generated by CV Diesel Service');

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage();

        // Set font for the body
        $pdf->SetFont('helvetica', '', 10); // Adjust the font size as needed

        // Write HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Laporan_Pemasukan_Truck_Crane.pdf', 'I');
        exit();
    } else {
        return redirect()->to('Home/login');
    }
}


public function print_pengeluaran_pdf()
{
    if (session()->get('id_level') > 0) {
        $tanggalawal = $this->request->getPost('tanggalawal2');
        $tanggalakhir = $this->request->getPost('tanggalakhir2');
		$kategori = $this->request->getPost('kategori2');

		$this->log_activity('User melakukan Print Pencatatan Pengeluaran PDF');

        $model = new M_pencatatan();
        $data = [
            'erwin' => $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane', 
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir', 
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
                $tanggalawal, 
                $tanggalakhir,
				$kategori // Pass the selected category
            ),
            'tanggalawal2' => $tanggalawal,
            'tanggalakhir2' => $tanggalakhir,
        ];

        // Load view content for PDF generation
        $html = view('print_pengeluaran_pdf', $data);
        require_once(ROOTPATH . 'Vendor/autoload.php');

        // Load TCPDF library with landscape orientation
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); // 'L' for landscape
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name'); // Change to your name
        $pdf->SetTitle('Laporan Pencatatan Pengeluaran');
        $pdf->SetSubject('Laporan');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set default header and footer data
        $pdf->setHeaderData('', 0, 'Laporan Pencatatan Pengeluaran', 'Generated by CV Diesel Service');

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage();

        // Set font for the body
        $pdf->SetFont('helvetica', '', 10); // Adjust the font size as needed

        // Write HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Laporan_Pengeluaran_Truck_Crane.pdf', 'I');
        exit();
    } else {
        return redirect()->to('Home/login');
    }
}

// public function print_pemasukan_excel()
//     {
//         if (session()->get('id_level') > 0) {
//             $tanggalawal = $this->request->getPost('tanggalawal3');
//             $tanggalakhir = $this->request->getPost('tanggalakhir3');

//             $model = new M_pencatatan();
//             $data = $model->betweenjoin1(
//                 'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir',
//                 'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane',
//                 'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir',
//                 $tanggalawal,
//                 $tanggalakhir
//             );

//             // Create new Spreadsheet object
//             $spreadsheet = new Spreadsheet();
//             $sheet = $spreadsheet->getActiveSheet();

//             // Set the title
//             $sheet->setCellValue('A1', 'Laporan Pemasukan Truck Crane');
//             $sheet->mergeCells('A1:K1');
//             $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
//             $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

//             // Set header
//             $headers = ['No', 'No Invoice', 'Tanggal', 'Truck Crane', 'Supir', 'Pelanggan', 'Pekerjaan', 'Lokasi', 'Total Jam', 'Status', 'Harga'];
//             $columnIndex = 1;
//             foreach ($headers as $header) {
//                 $sheet->setCellValueByColumnAndRow($columnIndex, 2, $header);
//                 $sheet->getStyleByColumnAndRow($columnIndex, 2)->getFont()->setBold(true);
//                 $sheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);
//                 $columnIndex++;
//             }

//             // Fill data
//             $rowIndex = 3;
//             $no = 1;
//             $totalHarga = 0;
//             foreach ($data as $row) {
//                 $sheet->setCellValueByColumnAndRow(1, $rowIndex, $no++);
//                 $sheet->setCellValueByColumnAndRow(2, $rowIndex, $row->no_invoice);
//                 $sheet->setCellValueByColumnAndRow(3, $rowIndex, $row->tanggal);
//                 $sheet->setCellValueByColumnAndRow(4, $rowIndex, $row->plat_truck);
//                 $sheet->setCellValueByColumnAndRow(5, $rowIndex, $row->nama);
//                 $sheet->setCellValueByColumnAndRow(6, $rowIndex, $row->pelanggan);
//                 $sheet->setCellValueByColumnAndRow(7, $rowIndex, $row->pekerjaan);
//                 $sheet->setCellValueByColumnAndRow(8, $rowIndex, $row->lokasi);
//                 $sheet->setCellValueByColumnAndRow(9, $rowIndex, $row->total_jam);
//                 $sheet->setCellValueByColumnAndRow(10, $rowIndex, $row->status);
//                 $sheet->setCellValueByColumnAndRow(11, $rowIndex, $row->harga);
//                 $totalHarga += $row->harga;
//                 $rowIndex++;
//             }

//             // Add total row
//             $sheet->setCellValueByColumnAndRow(10, $rowIndex, 'Total Harga:');
//             $sheet->setCellValueByColumnAndRow(11, $rowIndex, 'Rp ' . number_format($totalHarga, 0, ',', '.'));

//             // Apply borders to the table
//             $sheet->getStyle('A2:K' . $rowIndex)->getBorders()->applyFromArray([
//                 'allBorders' => [
//                     'borderStyle' => Border::BORDER_THIN,
//                     'color' => ['argb' => 'FF000000'],
//                 ],
//             ]);

//             // Apply borders to the header
//             $sheet->getStyle('A2:K2')->getBorders()->applyFromArray([
//                 'bottom' => [
//                     'borderStyle' => Border::BORDER_THICK,
//                     'color' => ['argb' => 'FF000000'],
//                 ],
//             ]);

//             // Set the filename and save the file
//             $filename = 'Laporan_Pemasukan_Truck_Crane.xlsx';
//             $writer = new Xlsx($spreadsheet);
//             $writer->save($filename);

//             // Force download
//             return $this->response->download($filename, null)->setFileName($filename);
//         } else {
//             return redirect()->to('Home/login');
//         }
//     }

public function print_pemasukan_excel()
{
    if (session()->get('id_level') > 0) {
        $tanggalawal = $this->request->getPost('tanggalawal');
        $tanggalakhir = $this->request->getPost('tanggalakhir');
        $status = $this->request->getPost('status');

		$this->log_activity('User melakukan Print Pencatatan Pemasukan Excel');

        $model = new M_pencatatan();
        $data = $model->betweenjoin1(
            'tb_pencatatan_truck_crane', 'tb_truck_crane', 'tb_supir',
            'tb_pencatatan_truck_crane.id_truck_crane=tb_truck_crane.id_truck_crane',
            'tb_pencatatan_truck_crane.id_supir=tb_supir.id_supir',
            $tanggalawal,
            $tanggalakhir,
            $status // Pass the status to the model
        );

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the title
        $sheet->setCellValue('A1', 'Laporan Pemasukan Truck Crane');
        $sheet->mergeCells('A1:K1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header
        $headers = ['No', 'No Invoice', 'Tanggal', 'Truck Crane', 'Supir', 'Pelanggan', 'Pekerjaan', 'Lokasi', 'Total Jam', 'Status', 'Harga'];
        $columnIndex = 1;
        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($columnIndex, 2, $header);
            $sheet->getStyleByColumnAndRow($columnIndex, 2)->getFont()->setBold(true);
            $sheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);
            $columnIndex++;
        }

        // Fill data
        $rowIndex = 3;
        $no = 1;
        $totalHarga = 0;
        foreach ($data as $row) {
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $no++);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $row->no_invoice);
            $sheet->setCellValueByColumnAndRow(3, $rowIndex, $row->tanggal);
            $sheet->setCellValueByColumnAndRow(4, $rowIndex, $row->plat_truck);
            $sheet->setCellValueByColumnAndRow(5, $rowIndex, $row->nama);
            $sheet->setCellValueByColumnAndRow(6, $rowIndex, $row->pelanggan);
            $sheet->setCellValueByColumnAndRow(7, $rowIndex, $row->pekerjaan);
            $sheet->setCellValueByColumnAndRow(8, $rowIndex, $row->lokasi);
            $sheet->setCellValueByColumnAndRow(9, $rowIndex, $row->total_jam);
            $sheet->setCellValueByColumnAndRow(10, $rowIndex, $row->status);
            $sheet->setCellValueByColumnAndRow(11, $rowIndex, $row->harga);
            $totalHarga += $row->harga;
            $rowIndex++;
        }

        // Add total row
        $sheet->setCellValueByColumnAndRow(10, $rowIndex, 'Total Harga:');
        $sheet->setCellValueByColumnAndRow(11, $rowIndex, 'Rp ' . number_format($totalHarga, 0, ',', '.'));

        // Apply borders to the table
        $sheet->getStyle('A2:K' . $rowIndex)->getBorders()->applyFromArray([
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ]);

        // Apply borders to the header
        $sheet->getStyle('A2:K2')->getBorders()->applyFromArray([
            'bottom' => [
                'borderStyle' => Border::BORDER_THICK,
                'color' => ['argb' => 'FF000000'],
            ],
        ]);

        // Set the filename and save the file
        $filename = 'Laporan_Pemasukan_Truck_Crane.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        // Force download
        return $this->response->download($filename, null)->setFileName($filename);
    } else {
        return redirect()->to('Home/login');
    }
}


	public function print_pengeluaran_excel()
    {
        if (session()->get('id_level') > 0) {
            $tanggalawal = $this->request->getPost('tanggalawal2');
            $tanggalakhir = $this->request->getPost('tanggalakhir2');
			$kategori = $this->request->getPost('kategori2');

			$this->log_activity('User melakukan Print Pencatatan Pengeluaran Excel');

            $model = new M_pencatatan();
            $data = $model->betweenjoin2(
                'tb_pencatatan_pengeluaran_tc', 'tb_truck_crane', 'tb_supir', 'tb_kategori',
                'tb_pencatatan_pengeluaran_tc.id_truck_crane=tb_truck_crane.id_truck_crane',
                'tb_pencatatan_pengeluaran_tc.id_supir=tb_supir.id_supir',
                'tb_pencatatan_pengeluaran_tc.id_kategori=tb_kategori.id_kategori',
                $tanggalawal,
                $tanggalakhir,
				$kategori // Pass the selected category
            );

            // Create new Spreadsheet object
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set the title
            $sheet->setCellValue('A1', 'Laporan Pencatatan Pengeluaran');
            $sheet->mergeCells('A1:G1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Set header
            $headers = ['No', 'Tanggal', 'Supir', 'Truck Crane', 'Deskripsi', 'Kategori', 'Harga'];
            $columnIndex = 1;
            foreach ($headers as $header) {
                $sheet->setCellValueByColumnAndRow($columnIndex, 2, $header);
                $sheet->getStyleByColumnAndRow($columnIndex, 2)->getFont()->setBold(true);
                $sheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);
                $columnIndex++;
            }

            // Fill data
            $rowIndex = 3;
            $no = 1;
            $totalHarga = 0;
            foreach ($data as $row) {
                $sheet->setCellValueByColumnAndRow(1, $rowIndex, $no++);
                $sheet->setCellValueByColumnAndRow(2, $rowIndex, $row->tanggal);
                $sheet->setCellValueByColumnAndRow(3, $rowIndex, $row->nama);
                $sheet->setCellValueByColumnAndRow(4, $rowIndex, $row->plat_truck);
                $sheet->setCellValueByColumnAndRow(5, $rowIndex, $row->deskripsi);
                $sheet->setCellValueByColumnAndRow(6, $rowIndex, $row->kategori);
                $sheet->setCellValueByColumnAndRow(7, $rowIndex, number_format($row->harga, 0, ',', '.'));
                $totalHarga += $row->harga;
                $rowIndex++;
            }

            // Add total row
            $sheet->setCellValueByColumnAndRow(6, $rowIndex, 'Total Harga:');
            $sheet->setCellValueByColumnAndRow(7, $rowIndex, 'Rp ' . number_format($totalHarga, 0, ',', '.'));

            // Apply borders to the table
            $sheet->getStyle('A2:G' . $rowIndex)->getBorders()->applyFromArray([
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]);

            // Apply borders to the header
            $sheet->getStyle('A2:G2')->getBorders()->applyFromArray([
                'bottom' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]);

            // Set the filename and save the file
            $filename = 'Laporan_Pengeluaran_Truck_Crane.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($filename);

            // Force download
            return $this->response->download($filename, null)->setFileName($filename);
        } else {
            return redirect()->to('Home/login');
        }
    }

	private function log_activity($activity)
    {
		$model = new M_pencatatan();
        $data = [
            'id_user'    => session()->get('id_user'),
            'activity'   => $activity,
			'timestamp' => date('Y-m-d H:i:s'),
			'delete_at' => '0'
        ];

        $model->tambah('tb_activity', $data);
	}

    public function activity()
    {
        if (session()->get('id_level')>0) {
            $model = new M_pencatatan();
            $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('tb_user', $where);
            $where = array('id_setting' => 1);
            $data['setting'] = $model->getWhere('tb_setting',$where);
            $this->log_activity('User membuka Log Activity');
            $data['erwin'] = $model->join('tb_activity', 'tb_user',
            'tb_activity.id_user = tb_user.id_user',$where);

        echo view('header' ,$data);
		echo view('menu',$data);
		echo view('activity',$data);
		echo view('footer');
	
		}else{
			return redirect()->to('home/login');
		}
        }

}
