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
}