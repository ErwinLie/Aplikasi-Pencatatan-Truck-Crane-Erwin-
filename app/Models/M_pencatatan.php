<?php

namespace App\Models;
use CodeIgniter\Model;

Class M_pencatatan extends Model
{ 
    public function tampil($tabel){
        return $this->db->table($tabel)
                        ->get()
                        ->getResult();
    }
    public function getById($id)
    {
        return $this->db->table('tb_user')
            ->where('id_user', $id)
            ->get()
            ->getRow();
    }
	public function edit($tabel, $isi, $where){
        return $this->db->table($tabel)
                        ->update($isi,$where);
    }
    public function hapus($table,$where)
    {
        return $this->db->table($table)
                        ->delete($where);

    }
    public function getWhere($table, $where)
    {
        return $this->db->table($table)
                        ->where($where)
                        ->get()
                        ->getRow();  // Return a single row as an object
    }
    
    public function join($tabel, $tabel2, $on){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->get()
                        ->getResult();
    }
    public function joinWhere($tabel, $tabel2, $on, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->getWhere($where)
                        ->getRow();
    
    }

    public function joinWheregetResult($tabel, $tabel2, $on, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on)
                        ->getWhere($where)
                        ->getResult();
    
    }

    public function joinThreeWhere($tabel, $tabel2, $tabel3, $on, $on2, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->getWhere($where)
                        ->getRow();
    
    }

    public function joinThreeWheregetResult($tabel, $tabel2, $tabel3, $on, $on2, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on)
                        ->join($tabel3, $on2)
                        ->getWhere($where)
                        ->getResult();
    
    }

    public function joinThreeTables($tabel, $tabel2, $tabel3, $on1, $on2){
        return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->get()
        ->getResult();
    }

    public function joinThreePencatatan($table1, $table2, $table3, $on1, $on2)
{
    return $this->db->table($table1)
        ->join($table2, $on1, 'left')
        ->join($table3, $on2, 'left')
        ->orderBy('id_pencatatan', 'DESC')
        ->get()
        ->getResult();
}

    public function joinThreeTablesquotation($tabel, $tabel2, $tabel3, $on1, $on2, $group_by_column){
        return $this->db->table($tabel)
            ->join($tabel2, $on1, 'left')
            ->join($tabel3, $on2, 'left')
            ->groupBy($group_by_column) // Mengelompokkan berdasarkan kolom no_quotation
            ->get()
            ->getResult();
    }

    public function joinFourWheregetResult($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on)
                        ->join($tabel3, $on2)
                        ->join($tabel4, $on3)
                        ->getWhere($where)
                        ->getResult();
    
    }

    public function joinFourTables($tabel, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3){
        return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->join($tabel4, $on3, 'left')
        ->get()
        ->getResult();
     }

     public function joinFourPengeluaran($tabel, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3){
        return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->join($tabel4, $on3, 'left')
        ->orderBy('id_pengeluaran_tc', 'DESC')
        ->get()
        ->getResult();
     }

     public function joinFourWhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->join($tabel4, $on3, 'left')
                        ->getWhere($where)
                        ->getRow();
    
    }
     
    public function joinFiveTables($tabel, $tabel2, $tabel3, $tabel4,$tabel5, $on1, $on2, $on3, $on4){
         return $this->db->table($tabel)
         ->join($tabel2, $on1, 'left')
         ->join($tabel3, $on2, 'left')
         ->join($tabel4, $on3, 'left')
         ->join($tabel5, $on4, 'left')
         ->get()
         ->getResult();
      }

      public function joinFiveWhere($tabel, $tabel2, $tabel3, $tabel4, $tabel5, $on, $on2, $on3, $on4, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->join($tabel4, $on3, 'left')
                        ->join($tabel5, $on4, 'left')
                        ->getWhere($where)
                        ->getRow();
    
    }
    
    public function tambah($tabel, $isi){
        return $this->db->table($tabel)
                        ->insert($isi);
    }

    public function upload($photo)
    {
        $imageName = $photo->getName();
        $photo->move(ROOTPATH . 'public/img', $imageName);
    }

    public function cari($tabel,$tabel2,$on,$awal,$akhir, $field){
        return $this->db->table($tabel)
                        ->join($tabel2,$on,'left')
                        ->getwhere($field." between '$awal' and '$akhir'")
                        ->getResult();
    }

    public function cari3($tabel, $tabel2, $tabel3, $on, $on2, $awal, $akhir){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->getWhere("tgl_pembayaran BETWEEN '$awal' AND '$akhir'")
                        ->getResult();
    
    }
    // public function cari4($tabel, $tabel2, $tabel3, $on, $on2, $awal, $akhir){
    //     return $this->db->table($tabel)
    //                     ->join($tabel2, $on, 'left')
    //                     ->join($tabel3, $on2, 'left')
    //                     ->getWhere("tgl BETWEEN '$awal' AND '$akhir'")
    //                     ->getResult();
    
    // }

    public function cari4($table1, $table2, $table3, $join1, $join2, $awal, $akhir)
    {
        return $this->builder($table1)
                    ->select('*')
                    ->join($table2, $join1)
                    ->join($table3, $join2)
                    ->where('tanggal >=', $awal)
                    ->where('tanggal <=', $akhir)
                    ->get()
                    ->getResult();
    }

    public function filterByDateAndStatus($table1, $table2, $table3, $on1, $on2, $awal, $akhir, $status)
{
    return $this->db->table($table1)
                    ->join($table2, $on1)
                    ->join($table3, $on2)
                    ->where('tanggal >=', $awal)
                    ->where('tanggal <=', $akhir)
                    ->where('status', $status)
                    ->get()
                    ->getResult();
}

public function filterByDateRange($table1, $table2, $table3, $on1, $on2, $awal, $akhir)
    {
        return $this->db->table($table1)
                        ->join($table2, $on1)
                        ->join($table3, $on2)
                        ->where('tanggal >=', $awal)
                        ->where('tanggal <=', $akhir)
                        ->get()
                        ->getResult();
    }

    public function filterByStatusAndDateRange($table1, $table2, $table3, $on1, $on2, $status, $awal, $akhir)
    {
        return $this->db->table($table1)
                        ->join($table2, $on1)
                        ->join($table3, $on2)
                        ->where('status', $status)
                        ->where('tanggal >=', $awal)
                        ->where('tanggal <=', $akhir)
                        ->get()
                        ->getResult();
    }

    public function filterByCriteria($table1, $table2, $table3, $on1, $on2, $status = null, $awal = null, $akhir = null, $truck_crane_id = null, $supir_id = null, $pelanggan_id = null)
{
    $builder = $this->db->table($table1)
                        ->join($table2, $on1)
                        ->join($table3, $on2);
    
    if ($status !== null) {
        $builder->where($table1 . '.status', $status);
    }

    if ($awal !== null && $akhir !== null) {
        $builder->where($table1 . '.tanggal >=', $awal)
                ->where($table1 . '.tanggal <=', $akhir);
    }

    if ($truck_crane_id !== null) {
        $builder->where($table2 . '.id_truck_crane', $truck_crane_id);
    }

    if ($supir_id !== null) {
        $builder->where($table3 . '.id_supir', $supir_id);
    }

    if ($pelanggan_id !== null) {
        $builder->where($table1 . '.pelanggan', $pelanggan_id);
    }

    return $builder->get()->getResult();
}


public function filterByCriteriaPengeluaran($table1, $table2, $table3, $table4, $on1, $on2, $on3, $status = null, $awal = null, $akhir = null, $truck_crane_id = null, $supir_id = null, $kategori_id = null)
{
    $builder = $this->db->table($table1)
                        ->join($table2, $on1)
                        ->join($table3, $on2)
                        ->join($table4, $on3);
    
    // if ($status !== null) {
    //     $builder->where($table1 . '.status', $status);
    // }

    if ($awal !== null && $akhir !== null) {
        $builder->where($table1 . '.tanggal >=', $awal)
                ->where($table1 . '.tanggal <=', $akhir);
    }

    if ($truck_crane_id !== null) {
        $builder->where($table2 . '.id_truck_crane', $truck_crane_id);
    }

    if ($supir_id !== null) {
        $builder->where($table3 . '.id_supir', $supir_id);
    }

    if ($kategori_id !== null) {
        $builder->where($table4 . '.kategori', $kategori_id);
    }

    return $builder->get()->getResult();
}





    public function getAll($table)
{
    return $this->db->table($table)->get()->getResult();
}

public function filterByStatus($table1, $table2, $table3, $on1, $on2, $status)
{
    return $this->db->table($table1)
                    ->join($table2, $on1)
                    ->join($table3, $on2)
                    ->where('status', $status)
                    ->get()
                    ->getResult();
}

//     public function filterByDateAndStatus($table1, $table2, $table3, $on1, $on2, $awal, $akhir, $status)
// {
//     return $this->db->table($table1)
//                     ->join($table2, $on1)
//                     ->join($table3, $on2)
//                     ->where('tanggal >=', $awal)
//                     ->where('tanggal <=', $akhir)
//                     ->where('status', $status)
//                     ->get()
//                     ->getResult();
// }


public function cari5($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $awal, $akhir){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->join($tabel4, $on3, 'left')
                        ->getWhere("tgl_invoice BETWEEN '$awal' AND '$akhir'")
                        ->getResult();
    }

    public function resetpassword($table,$kolom,$id,$data)
{
    
    $this->db->table($table)->where($kolom, $id)->update($data);
}

public function getSetting()
    {
        // Fetch settings from the database or other source
        return $this->db->table('tb_setting')->get()->getRow();
    }

//     public function betweenjoin1($table1,$table2,$table3,$on1,$on2,$tanggalAwal, $tanggalAkhir)
// {
//         return $this->db->table($table1)
//         ->join($table2,$on1)
//         ->join($table3,$on2)
//         ->where('tb_pencatatan_truck_crane.tanggal>=', $tanggalAwal)
//         ->where('tb_pencatatan_truck_crane.tanggal<=', $tanggalAkhir)
//         ->get()
//         ->getResult();
// }

// public function betweenjoin1($table1, $table2, $table3, $on1, $on2, $tanggalAwal, $tanggalAkhir, $status)
// {
//     $builder = $this->db->table($table1)
//         ->join($table2, $on1)
//         ->join($table3, $on2)
//         ->where('tb_pencatatan_truck_crane.tanggal >=', $tanggalAwal)
//         ->where('tb_pencatatan_truck_crane.tanggal <=', $tanggalAkhir);
        
//     if ($status != "") {
//         $builder->where('tb_pencatatan_truck_crane.status', $status);
//     }

//     return $builder->get()->getResult();
// }

// public function betweenjoin1($table1, $table2, $table3, $on1, $on2, $tanggalAwal, $tanggalAkhir, $status)
// {
//     $builder = $this->db->table($table1)
//         ->join($table2, $on1)
//         ->join($table3, $on2)
//         ->where('tb_pencatatan_truck_crane.tanggal >=', $tanggalAwal)
//         ->where('tb_pencatatan_truck_crane.tanggal <=', $tanggalAkhir);
        
//     if ($status != "") {
//         $builder->where('tb_pencatatan_truck_crane.status', $status);
//     }

//     return $builder->get()->getResult();
// }

public function betweenjoin1($table1, $table2, $table3, $joinCondition1, $joinCondition2, $tanggalawal = null, $tanggalakhir = null, $status = null)
{
    $builder = $this->db->table($table1)
        ->join($table2, $joinCondition1)
        ->join($table3, $joinCondition2);

    // Jika tanggal awal dan tanggal akhir diberikan, lakukan filtering
    if ($tanggalawal && $tanggalakhir) {
        $builder->where('tanggal >=', $tanggalawal)
                ->where('tanggal <=', $tanggalakhir);
    }

    // Jika status diberikan, lakukan filtering berdasarkan status
    if ($status) {
        $builder->where('status', $status);
    }

    return $builder->get()->getResult();
}

public function betweenjoin1pdf($table1, $table2, $table3, $on1, $on2, $tanggalAwal, $tanggalAkhir, $status)
{
    $builder = $this->db->table($table1)
        ->join($table2, $on1)
        ->join($table3, $on2)
        ->where('tb_pencatatan_truck_crane.tanggal >=', $tanggalAwal)
        ->where('tb_pencatatan_truck_crane.tanggal <=', $tanggalAkhir);

    if (!empty($status)) {
        $builder->where('tb_pencatatan_truck_crane.status', $status);
    }

    return $builder->get()->getResult();
}

// public function betweenjoin2($table1,$table2,$table3,$table4,$on1,$on2,$on3,$tanggalAwal, $tanggalAkhir)
// {
//         return $this->db->table($table1)
//         ->join($table2,$on1)
//         ->join($table3,$on2)
//         ->join($table4,$on3)
//         ->where('tb_pencatatan_pengeluaran_tc.tanggal>=', $tanggalAwal)
//         ->where('tb_pencatatan_pengeluaran_tc.tanggal<=', $tanggalAkhir)
//         ->get()
//         ->getResult();
// }

// public function betweenjoin2($table1, $table2, $table3, $table4, $on1, $on2, $on3, $tanggalAwal, $tanggalAkhir, $kategori = null)
// {
//     $builder = $this->db->table($table1)
//         ->join($table2, $on1)
//         ->join($table3, $on2)
//         ->join($table4, $on3)
//         ->where('tb_pencatatan_pengeluaran_tc.tanggal >=', $tanggalAwal)
//         ->where('tb_pencatatan_pengeluaran_tc.tanggal <=', $tanggalAkhir);

//     if ($kategori) {
//         $builder->where('tb_pencatatan_pengeluaran_tc.id_kategori', $kategori);
//     }

//     return $builder->get()->getResult();
// }

public function betweenjoin2($table1, $table2, $table3, $table4, $joinCondition1, $joinCondition2, $joinCondition3, $tanggalAwal = null, $tanggalAkhir = null, $kategori = null)
{
    $builder = $this->db->table($table1)
        ->join($table2, $joinCondition1)
        ->join($table3, $joinCondition2)
        ->join($table4, $joinCondition3);

    // Jika tanggal awal dan tanggal akhir diberikan, lakukan filtering
    if ($tanggalAwal && $tanggalAkhir) {
        $builder->where('tb_pencatatan_pengeluaran_tc.tanggal >=', $tanggalAwal)
                ->where('tb_pencatatan_pengeluaran_tc.tanggal <=', $tanggalAkhir);
    }

    // Jika kategori diberikan, lakukan filtering berdasarkan kategori
    if ($kategori) {
        $builder->where('tb_pencatatan_pengeluaran_tc.id_kategori', $kategori);
    }

    return $builder->get()->getResult();
}

public function tampilpencatatan($table2)
{
    return $this->db->table($table2)->orderBy('id_pencatatan', 'DESC')->get()->getResultArray();
}

public function tampil2($tabel){
    return $this->db->table($tabel)
                    ->orderBy('id_supir', 'DESC')
                    ->get()
                    ->getResult();
}

public function tampil3($tabel){
    return $this->db->table($tabel)
                    ->orderBy('id_truck_crane', 'DESC')
                    ->get()
                    ->getResult();
}

public function tampil4($tabel){
    return $this->db->table($tabel)
                    ->orderBy('id_kategori', 'DESC')
                    ->get()
                    ->getResult();
}

public function get_filtered_pemasukan($tanggalawal, $tanggalakhir, $status)
{
    $this->db->select('*');
    $this->db->from('tb_pencatatan_truck_crane'); // Replace with your actual table name

    // Apply date range filter if provided
    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
        $this->db->where('tanggal >=', $tanggalawal);
        $this->db->where('tanggal <=', $tanggalakhir);
    }

    // Apply status filter if provided
    if (!empty($status)) {
        $this->db->where('status', $status);
    }

    $query = $this->db->get();
    return $query->result();
}

public function get_filtered_pengeluaran($tanggalawal, $tanggalakhir, $kategori)
{
    $this->db->select('*');
    $this->db->from('tb_pencatatan_pengeluaran_tc'); // Replace with your actual table name

    // Apply date range filter if provided
    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
        $this->db->where('tanggal >=', $tanggalawal);
        $this->db->where('tanggal <=', $tanggalakhir);
    }

    // Apply category filter if provided
    if (!empty($kategori)) {
        $this->db->where('id_kategori', $kategori);
    }

    $query = $this->db->get();
    return $query->result();
}

public function join3tblPencatatan($tabel1, $tabel2, $tabel3, $on1, $on2, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->where("$tabel1.delete_at", null); // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join3tblPencatatan2($tabel1, $tabel2, $tabel3, $on1, $on2, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->where("$tabel1.delete_at IS NOT NULL"); // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join4tblPengeluaran($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->where("$tabel1.delete_at", null); // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function join4tblPengeluaran2($tabel1, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $orderByColumn = null, $orderDirection = 'ASC')
    {
        $builder = $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->join($tabel4, $on3, 'inner')
            ->where("$tabel1.delete_at IS NOT NULL"); // Menambahkan kondisi where deleted_at is null

        if ($orderByColumn) {
            $builder->orderBy($orderByColumn, $orderDirection);
        }

        return $builder->get()->getResult();
    }

    public function saveToBackup($table, $data)
    {
        $this->db->table($table)->insert($data);
    }

    public function getPassword($userId)
    {
        return $this->db->table('tb_user')
            ->select('password')
            ->where('id_user', $userId)
            ->get()
            ->getRow()
            ->password;
    }

    public function getWhere1($table, $where)
    {
        return $this->db->table($table)->where($where)->get();
    }

    protected $table = 'tb_pencatatan_truck_crane';

    public function getTotalPemasukan()
    {
        return $this->selectSum('harga')->get()->getRow()->harga;
    }

    // public function getTotalPengeluaran()
    // {
    //     return $this->selectSum('harga')->get()->getRow()->harga;
    // }

    public function getTotalPengeluaran()
{
    return $this->db->table('tb_pencatatan_pengeluaran_tc')
                    ->selectSum('harga')
                    ->get()
                    ->getRow()
                    ->harga;
}

    public function getTotalPemasukanByDateRange($startDate, $endDate)
    {
        return $this->where('tanggal >=', $startDate)
                    ->where('tanggal <=', $endDate)
                    ->selectSum('harga')
                    ->get()
                    ->getRow()
                    ->harga ?? 0; // Use ?? 0 to return 0 if no result found
    }

    
    


}