<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];
	//--------------------------------------------------------------------
	// Rules LOGIN
	//--------------------------------------------------------------------
	public $login = [
		'email'     => 'required|trim',
		'password' => 'required|trim',

	];
	public $login_errors  = [
		'email' => [
			'required' => 'Email Masih Kosong',
		],
		'password' => [
			'required' => 'Password Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules USER
	//--------------------------------------------------------------------
	public $userfoto = [
		'foto' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]'
	];
	public $userfoto_errors = [
		'foto' => [
			'uploaded' => 'Foto Belum Dipilih',
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];
	public $usertext = [
		'email' => 'required|valid_email',
		'password' => 'required|min_length[8]',
		'repass' => 'required|matches[password]',
		'nama' => 'required',
	];
	public $usertext_errors = [
		'email' => [
			'required' => 'Verifikasi Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'password' => [
			'required' => 'Password Masih Kosong', 'min_length' => 'Password Minimal 8 Karakter'
		],
		'repass' => [
			'required' => 'Verifikasi Password Masih Kosong', 'matches' => 'Password dan Repeat Password Berbeda'
		],
		'nama' => [
			'required' => 'Verifikasi Nama Masih Kosong'
		]
	];

	public $usertextEdit = [
		'email' => 'required|valid_email',
		'status' => 'required'
	];
	public $usertextEdit_errors = [
		'email' => [
			'required' => 'Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'status' => [
			'required' => 'Status Pegawai Masih Kosong'
		]
	];
	public $uploaded = [
		'foto' => 'uploaded[foto]'
	];
	public $userfotoEdit = [
		'foto' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]'
	];
	public $userfotoEdit_errors = [
		'foto' => [
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];

	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Dinas
	//--------------------------------------------------------------------
	public $koderekeningdinas = [
		'kode_rek_dinas' => 'required',
		'nama_rek_dinas' => 'required',
	];
	public $koderekeningdinas_errors = [
		'kode_rek_dinas' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_dinas' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];
	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Urusan
	//--------------------------------------------------------------------
	public $koderekeningurusan = [
		'kode_rek_urusan' => 'required',
		'nama_rek_urusan' => 'required',
	];
	public $koderekeningurusan_errors = [
		'kode_rek_urusan' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_urusan' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];
	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Bidang
	//--------------------------------------------------------------------
	public $koderekeningbidang = [
		'kode_rek_bidang' => 'required',
		'nama_rek_bidang' => 'required',
	];
	public $koderekeningbidang_errors = [
		'kode_rek_bidang' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_bidang' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];
	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Program
	//--------------------------------------------------------------------
	public $koderekeningprogram = [
		'kode_rek_program' => 'required',
		'nama_rek_program' => 'required',
	];
	public $koderekeningprogram_errors = [
		'kode_rek_program' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_program' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];
	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Kegiatan
	//--------------------------------------------------------------------
	public $koderekeningkegiatan = [
		'kode_rek_kegiatan' => 'required',
		'nama_rek_kegiatan' => 'required',
	];
	public $koderekeningkegiatan_errors = [
		'kode_rek_kegiatan' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_kegiatan' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];
	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar Unit
	//--------------------------------------------------------------------
	public $koderekeningunit = [
		'kode_rek_unit' => 'required',
		'nama_rek_unit' => 'required',
	];
	public $koderekeningunit_errors = [
		'kode_rek_unit' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'nama_rek_unit' => [
			'required' => 'Nama Rekening Belum Terisi'
		]
	];

	//--------------------------------------------------------------------
	// Rules  Rekening Dasar 
	//--------------------------------------------------------------------
	public $rekeningdasar = [
		'nama_rekening_dasar' => 'required',
		'kode_rek_dinas' => 'required',
		'kode_rek_urusan' => 'required',
		'kode_rek_bidang' => 'required',
		'kode_rek_program' => 'required',
		'kode_rek_kegiatan' => 'required',
		'kode_rek_unit' => 'required',
		'tahun_anggaran' => 'required',
		'jumlah_anggaran_rekening_dasar' => 'required',
	];
	public $rekeningdasar_errors = [
		'nama_rekening_dasar' => [
			'required' => 'Nama Rekening Belum Terisi'
		],'kode_rek_dinas' => [
			'required' => 'Kode Dinas Belum Terisi'
		],'kode_rek_urusan' => [
			'required' => 'Kode Urusan Belum Terisi'
		],'kode_rek_bidang' => [
			'required' => 'Kode Bidang Belum Terisi'
		],'kode_rek_program' => [
			'required' => 'Kode Program Belum Terisi'
		],'kode_rek_kegiatan' => [
			'required' => 'Kode Kegiatan Belum Terisi'
		],'kode_rek_unit' => [
			'required' => 'Kode Unit Belum Terisi'
		],'tahun_anggaran' => [
			'required' => 'Tahun Anggaran Belum Terisi'
		],'jumlah_anggaran_rekening_dasar' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		]
	];

	public $kpappk = [
		'nip_kpa_ppk' => ['required', 'is_unique[tb_kpa_ppk.nip_kpa_ppk]'],
		'nama_kpa_ppk' => ['required', 'is_unique[tb_kpa_ppk.nip_kpa_ppk]'],
	];
	public $kpappk_errors = [
		'nip_kpa_ppk' => [
			'required' => 'NIP KPA PPK Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		],
		'nama_kpa_ppk' => [
			'required' => 'Nama KPA PPK Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		]
	];

	public $kpappk_edit = [
		'nip_kpa_ppk' => ['required'],
		'nama_kpa_ppk' => ['required'],
	];
	public $kpappk_edit_errors = [
		'nip_kpa_ppk' => [
			'required' => 'NIP KPA PPK Belum Terisi'
		],
		'nama_kpa_ppk' => [
			'required' => 'Nama KPA PPK Belum Terisi'
		]
	];

	public $pptk = [
		'nip_pptk' => ['required', 'is_unique[tb_pptk.nip_pptk]'],
		'nama_pptk' => ['required', 'is_unique[tb_pptk.nip_pptk]'],
	];
	public $pptk_errors = [
		'nip_pptk' => [
			'required' => 'NIP PPTK Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		],
		'nama_pptk' => [
			'required' => 'Nama PPTK Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		]
	];

	public $pptk_edit = [
		'nip_pptk' => ['required'],
		'nama_pptk' => ['required'],
	];
	public $pptk_edit_errors = [
		'nip_pptk' => [
			'required' => 'NIP PPTK Belum Terisi'
		],
		'nama_pptk' => [
			'required' => 'Nama PPTK Belum Terisi'
		]
	];

	public $bendahara = [
		'nip_bendahara' => ['required', 'is_unique[tb_bendahara.nip_bendahara]'],
		'nama_bendahara' => ['required', 'is_unique[tb_bendahara.nip_bendahara]'],
	];
	public $bendahara_errors = [
		'nip_bendahara' => [
			'required' => 'NIP Bendahara Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		],
		'nama_bendahara' => [
			'required' => 'Nama Bendahara Belum Terisi',
			'is_unique' => 'Pegawai Sudah Terdapat Di Dalam Sistem'
		]
	];

	public $bendahara_edit = [
		'nip_bendahara' => ['required'],
		'nama_bendahara' => ['required'],
	];
	public $bendahara_edit_errors = [
		'nip_bendahara' => [
			'required' => 'NIP Bendahara Belum Terisi'
		],
		'nama_bendahara' => [
			'required' => 'Nama Bendahara Belum Terisi'
		]
	];

	public $koderekeningdasar = [
		'id_kode_dinas' => ['required'],
		'id_kode_urusan' => ['required'],
		'id_kode_bidang' => ['required'],
		'id_kode_program' => ['required'],
		'id_kode_kegiatan' => ['required'],
		'id_kode_unit' => ['required'],
		'nama_rekening_dasar' => ['required'],
		'tahun_anggaran' => ['required'],
		'jumlah_anggaran_rekening_dasar' => ['required'],
		'id_kpa_ppk' => ['required'],
		'id_pptk' => ['required'],
		'id_bendahara' => ['required']
	];

	public $koderekeningdasar_errors = [
		'id_kode_dinas' => [
			'required' => 'Kode DinasBelum Terisi'
		],
		'id_kode_urusan' => [
			'required' => 'Kode Urusan Belum Terisi'
		],
		'id_kode_bidang' => [
			'required' => 'Kode Bidang Belum Terisi'
		],
		'id_kode_program' => [
			'required' => 'Kode Program Belum Terisi'
		],
		'id_kode_kegiatan' => [
			'required' => 'Kode Kegiatan Belum Terisi'
		],
		'id_kode_unit' => [
			'required' => 'Kode Unit Belum Terisi'
		],
		'nama_rekening_dasar' => [
			'required' => 'Nama Rekening Dasar Belum Terisi'
		],
		'tahun_anggaran' => [
			'required' => 'Tahun Anggaran Belum Terisi'
		],
		'jumlah_anggaran_rekening_dasar' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_kpa_ppk' => [
			'required' => 'KPA PPK Belum Terisi'
		],
		'id_pptk' => [
			'required' => 'PPTK Belum Terisi'
		],
		'id_bendahara' => [
			'required' => 'Bendahara Belum Terisi'
		]
	];

	public $kodebelanjasub1 = [
		'kode_belanja_sub1' => 'required',
		'nama_rekening_belanja_sub1' => 'required',
		'jumlah_anggaran_belanja_sub1' => 'required',
		'id_rekening_dasar' => 'required'
	];

	public $kodebelanjasub1_errors = [
		'kode_belanja_sub1' => [
			'required' => 'Kode Belanja Belum Terisi'
		],
		'nama_rekening_belanja_sub1' => [
			'required' => 'Nama Rekening Belanja Belum Terisi'
		],
		'jumlah_anggaran_belanja_sub1' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_rekening_dasar' => [
			'required' => 'Rekening Dasar Belum Terisi'
		]
	];

	public $kodebelanjasub2 = [
		'kode_belanja_sub2' => 'required',
		'nama_rekening_belanja_sub2' => 'required',
		'jumlah_anggaran_belanja_sub2' => 'required',
		'id_kode_belanja_sub1' => 'required'
	];

	public $kodebelanjasub2_errors = [
		'kode_belanja_sub2' => [
			'required' => 'Kode Belanja Belum Terisi'
		],
		'nama_rekening_belanja_sub2' => [
			'required' => 'Nama Rekening Belanja Belum Terisi'
		],
		'jumlah_anggaran_belanja_sub2' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_kode_belanja_sub1' => [
			'required' => 'Referensi Rekening Belum Terisi'
		]
	];

	public $kodebelanjasub3 = [
		'kode_belanja_sub3' => 'required',
		'nama_rekening_belanja_sub3' => 'required',
		'jumlah_anggaran_belanja_sub3' => 'required',
		'id_kode_belanja_sub2' => 'required'
	];

	public $kodebelanjasub3_errors = [
		'kode_belanja_sub3' => [
			'required' => 'Kode Belanja Belum Terisi'
		],
		'nama_rekening_belanja_sub3' => [
			'required' => 'Nama Rekening Belanja Belum Terisi'
		],
		'jumlah_anggaran_belanja_sub3' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_kode_belanja_sub2' => [
			'required' => 'Referensi Rekening Belum Terisi'
		]
	];

	public $kodebelanjasub4 = [
		'kode_belanja_sub4' => 'required',
		'nama_rekening_belanja_sub4' => 'required',
		'jumlah_anggaran_belanja_sub4' => 'required',
		'id_kode_belanja_sub3' => 'required'
	];

	public $kodebelanjasub4_errors = [
		'kode_belanja_sub4' => [
			'required' => 'Kode Belanja Belum Terisi'
		],
		'nama_rekening_belanja_sub4' => [
			'required' => 'Nama Rekening Belanja Belum Terisi'
		],
		'jumlah_anggaran_belanja_sub4' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_kode_belanja_sub3' => [
			'required' => 'Referensi Rekening Belum Terisi'
		]
	];

	public $kodebelanjasub5 = [
		'kode_belanja_sub5' => 'required',
		'nama_rekening_belanja_sub5' => 'required',
		'jumlah_anggaran_belanja_sub5' => 'required',
		'id_kode_belanja_sub4' => 'required'
	];

	public $kodebelanjasub5_errors = [
		'kode_belanja_sub5' => [
			'required' => 'Kode Belanja Belum Terisi'
		],
		'nama_rekening_belanja_sub5' => [
			'required' => 'Nama Rekening Belanja Belum Terisi'
		],
		'jumlah_anggaran_belanja_sub5' => [
			'required' => 'Jumlah Anggaran Belum Terisi'
		],
		'id_kode_belanja_sub4' => [
			'required' => 'Referensi Rekening Belum Terisi'
		]
	];

	public $orders = [
		'no_pesanan	' => 'required',
		'tgl_pesanan' => 'required',
		'id_rekening_dasar' => 'required',
		'id_kode_belanja_sub5' => 'required',
		'id_rekanan' => 'required',
		'jenis_barang' => 'required',
		'jumlah_barang' => 'required',
		'jenis_satuan_barang' => 'required',
		'uraian_pesanan' => 'required'
	];

	public $orders_errors = [
		'no_pesanan' => [
			'required' => 'Nomor Pesanan Belum Terisi'
		],
		'tgl_pesanan' => [
			'required' => 'Tanggal Pesanan Belum Terisi'
		],
		'id_rekening_dasar' => [
			'required' => 'Rekening Dasar Belum Terisi'
		],
		'id_kode_belanja_sub5' => [
			'required' => 'Rekening Belanja Belum Terisi'
		],
		'id_rekanan' => [
			'required' => 'Data Rekanan Belum Terisi'
		],
		'jenis_barang' => [
			'required' => 'Jenis Barang Belum Terisi'
		],
		'jumlah_barang' => [
			'required' => 'Jumlah Barang Belum Terisi'
		],
		'jenis_satuan_barang' => [
			'required' => 'Jenis Satuan Barang Belum Terisi'
		],
		'uraian_pesanan' => [
			'required' => 'Uraian Pesanan Belum Terisi'
		]
	];

	public $rekanan = [
		'instansi_rekanan' => 'required',
		'nama_rekanan' => 'required',
		'alamat_rekanan' => 'required',
		'no_telp_rekanan' => 'required',
		'npwp' => 'required',
		'bank_rekanan' => 'required',
		'no_rekening_rekanan' => 'required',
		'jabatan' => 'required'
	];

	public $rekanan_errors = [
		'instansi_rekanan' => [
			'required' => 'Instansi Rekanan Belum Terisi'
		],
		'nama_rekanan' => [
			'required' => 'Nama Rekanan Belum Terisi'
		],
		'alamat_rekanan' => [
			'required' => 'Alamat Rekanan Belum Terisi'
		],
		'no_telp_rekanan' => [
			'required' => 'No Telepon Rekanan Belum Terisi'
		],
		'npwp' => [
			'required' => 'NPWP Rekanan Belum Terisi'
		],
		'bank_rekanan' => [
			'required' => 'Bank Rekanan Belum Terisi'
		],
		'no_rekening_rekanan' => [
			'required' => 'No Rekening Rekanan Belum Terisi'
		],
		'jabatan' => [
			'required' => 'Jabatan Barang Belum Terisi'
		]
	];

	public $kuwitansi = [
		'no_kuwitansi' => 'required',
		'tgl_kuwitansi' => 'required',
		'id_rekening_dasar' => 'required',
		'id_kode_belanja_sub5' => 'required',
		'nominal' => 'required',
		'uraian_belanja' => 'required',
		'dasar_spj_bukti' => 'required',
		'id_rekanan' => 'required',
		'keterangan_spj' => 'required',
		'status_spj' => 'required'
	];
	
	public $kuwitansi_errors = [
		'no_kuwitansi' => [
			'required' => 'No Kuwitansi Belum Terisi'
		],
		'tgl_kuwitansi' => [
			'required' => 'Tanggal Kuwitansi Belum Terisi'
		],
		'id_rekening_dasar' => [
			'required' => 'Rekening Dasar Belum Terisi'
		],
		'id_kode_belanja_sub5' => [
			'required' => 'Rekening Belanja Belum Terisi'
		],
		'nominal' => [
			'required' => 'Nominal Belum Terisi'
		],
		'uraian_belanja' => [
			'required' => 'Uraian Belanja Belum Terisi'
		],
		'dasar_spj_bukti' => [
			'required' => 'Dasar SPJ Belum Terisi'
		],
		'id_rekanan' => [
			'required' => 'Instansi Rekanan Belum Terisi'
		],
		'keterangan_spj' => [
			'required' => 'Keterangan Belum Terisi'
		],
		'status_spj' => [
			'required' => 'Status SPJ Belum Terisi'
		]
	];
}