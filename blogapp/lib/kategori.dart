

class Kategori {
  String name;
  String idkategori;
  Kategori({this.name, this.idkategori});
  factory Kategori.fromJson(Map<String, dynamic> json) {
    return Kategori(
      name: json['nama'] as String,
      idkategori: json['idkategori'] as String,
    );
  }
}