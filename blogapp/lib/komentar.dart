class Komentar {
  String nama;
  String isi;
  String tgl;

  Komentar({this.isi,this.tgl,this.nama});
  factory Komentar.fromJson(Map<String, dynamic> json) {
    return Komentar(
      isi: json['isi'] as String,
      tgl: json['tgl_update'] as String,
      nama: json['nama'] as String,
    );
  }
}