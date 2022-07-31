-- database apotek
drop database db_apotek;
create database db_apotek;

-- tabel obat
drop table tb_obat;
create table tb_obat(
	id_obat varchar (10) primary key,
	nama_obat varchar (50) not null,
	jenis_obat varchar(50) not null,
	harga_obat int not null,
	kegunaan_obat varchar(500) not null
);

insert into tb_obat (id_obat, nama_obat, jenis_obat, harga_obat, kegunaan_obat)
	values
	('IDO-0001','Mylanta', 'Sirup kering', 40000, 'Meredakan gejala sakit maag, mual, dan perut kembung'),
	('IDO-0002','Paracetamol', 'Tablet', 15000, 'Penurun demam dan pereda nyeri'),
	('IDO-0003','Puyer Bintang Toedjoe', 'Sirup kering', 10000, 'Mengobati sakit kepala, nyeri haid, sakit gigi, rematik'),
	('IDO-0004','Diapet', 'Kapsul', 5000, 'Mengatasi diare'),
	('IDO-0005','Inerson', 'Obat oles', 80000, 'Mengobati eksim, dermatitis, dan psoriasis');

select * from tb_obat;


-- tabel customer;
drop table tb_customer;
create table tb_customer(
	id_cust varchar (10) primary key,
	nama_cust varchar (50) not null,
	alamat varchar(50) not null,
	jenis_kelamin varchar (50) not null,
	no_hp varchar(50) not null,
	tanggal_lahir date not null
);

insert into tb_customer (id_cust, nama_cust, alamat, jenis_kelamin, no_hp, tanggal_lahir)
	values
	('IDC-0001', 'Zahra', 'Dramaga', 'Perempuan', '085421325546', '2000-08-17'),
	('IDC-0002', 'Fahdan', 'Ciomas', 'Laki-laki', '089542426670', '2001-10-10'),
	('IDC-0003', 'Andro', 'Ciampea', 'Laki-laki', '081289897760', '2001-06-09'),
	('IDC-0004', 'Putri', 'Leuwiliang', 'Perempuan', '085742100022', '2001-07-05');

select * from tb_customer;


-- tabel karyawan;
drop table tb_karyawan;
create table tb_karyawan(
	id_karyawan varchar(10) primary key,
	nama_karyawan varchar (50) not null,
	divisi varchar (50) not null,
	alamat varchar(50) not null,
	no_hp varchar(15) not null
);

insert into tb_karyawan (id_karyawan, nama_karyawan, divisi, alamat, no_hp)
	values
	('G74180045', 'Ahmad Rizky', 'Front Office', 'Dramaga', '0896359976477'),
	('G14190009', 'Faridatun Nisa', 'Front Office', 'Dramaga', '0896424399811'),
	('G14190037', 'Widya Luthfiani', 'Front Office', 'Dramaga', '081382821140'),
	('G14190041', 'Syuhaira Asyva Winanda', 'Web Developer', 'Dramaga', '082388135812');
	
select * from tb_karyawan;


-- tabel transaksi penjualan;
drop table tb_transaksi_penjualan;
create table tb_transaksi_penjualan(
	id_cust varchar (10) not null
		references tb_customer(id_cust),
	id_obat varchar (10) not null
		references tb_obat(id_obat),
	id_karyawan varchar (10) not null
		references tb_karyawan(id_karyawan),
	tanggal_transaksi date not null,
	total_harga int not null,
	primary key(id_cust, id_obat, id_karyawan)
	);

insert into tb_transaksi_penjualan (id_cust, id_obat, id_karyawan, tanggal_transaksi, total_harga)
	values
	('IDC-0002', 'IDO-0001', 'G74180045', '2021-06-13', '80000'),
	('IDC-0001', 'IDO-0002', 'G74180045', '2021-06-14', '15000'),
	('IDC-0004', 'IDO-0003', 'G14190037', '2021-06-15', '10000');

select*from tb_transaksi_penjualan;


-- ================================================================================================
-- View dan Join ----------------------------------------------------------------------------------
-- ================================================================================================
select * from tb_transaksi_penjualan;
select
	B.nama_cust, A.nama_obat, C.nama_karyawan, D.tanggal_transaksi, D.total_harga
from
	tb_obat A, tb_customer B, tb_karyawan C, tb_transaksi_penjualan D
where
	A.id_obat = D.id_obat and B.id_cust = D.id_cust and C.id_karyawan = D.id_karyawan;


select * from tb_obat;
select * from tb_customer;
select * from tb_karyawan;
select * from tb_transaksi_penjualan;

