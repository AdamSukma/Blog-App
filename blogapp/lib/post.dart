class Post {
  String idpost;
  String judul;
  String idkategori;
  String isipost;
  String filegambar;
  String tglinsert;
  String tglupdate;
  String idpenulis;

  Post({this.idpost,this.judul,this.idkategori,this.isipost,this.filegambar,this.tglinsert,this.tglupdate,
  this.idpenulis});

  factory Post.fromJson(Map<String, dynamic> json) {
    return Post(
      idpost: json['idpost'] as String,
      judul: json['judul'] as String,
      idkategori: json['idkategori'] as String,
      isipost: json['isi_post'] as String,
      filegambar: json['file_gambar'] as String,
      tglinsert: json['tgl_insert'] as String,
      tglupdate: json['tgl_update'] as String,
      idpenulis: json['id_penulis'] as String
    );
  }
}