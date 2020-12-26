import 'package:blogapp/post.dart';
import 'package:flutter/material.dart';
import 'service.dart';
import 'detail.dart';

class ViewPost extends StatefulWidget {
  @override
  _ViewPostState createState() => _ViewPostState();
}

class _ViewPostState extends State<ViewPost> {
  List<Post> _post;
  List<String> _namapenulis = [];
  @override
  void initState() {
    super.initState();
    Services.getPost().then((post) {
      setState(() {
        _post = post;
        _namapenulis = new List(99);
        for (Post p in _post) {
          Services.getNamaPenulis(p.idpenulis).then((namapenulis) {
            setState(() {
              _namapenulis[int.parse(p.idpost)] = (namapenulis);
            });
          });
        }
      });
    });
  }

  // _getNamaPenulis(String idpenulis){
  //   Services.getNamaPenulis(idpenulis).then((namapenulis){
  //     setState(() {
  //       _namapenulis = namapenulis;
  //     });
  //   });
  // }

  @override
  Widget build(BuildContext context) {
    return new Container(
      child: new Center(
          child: ListView.builder(
              itemCount: _post == null ? 0 : _post.length,
              itemBuilder: (BuildContext context, int index) {
                // print("nama penulis $_namapenulis");
                return PreviewPost(
                    _post[index], _namapenulis[int.parse(_post[index].idpost)]);
              })),
    );
  }
}

class PreviewPost extends StatelessWidget {
  Post post;
  String namapenulis;
  PreviewPost(this.post, this.namapenulis);
  @override
  Widget build(BuildContext context) {
    return new Container(
      padding: new EdgeInsets.all(10.0),
      child: new Card(
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(20.0)),
          child: RaisedButton(
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(20.0)),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                    builder: (context) => Detail(
                          judul: "Post 1",
                          penulis: "Mr A",
                          tanggal: "20 Desember 2020",
                          gambar: "img/bromo.jpg",
                          isi:
                              "Variabel dummy adalah variabel yang digunakan untuk mengkuantitatifkan variabel yang bersifat kualitatif (misal: jenis kelamin, ras, agama, perubahan kebijakan pemerintah, perbedaan situasi dan lain-lain).",
                          penuliskomentar: "bambang",
                          tglkomentar: "24 Desember 2020",
                          isikomentar: "bagus sekalii",
                        )),
              );
            },
            child: new Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: <Widget>[
                new Image.network(post.filegambar),
                new Padding(padding: new EdgeInsets.all(5.0)),
                new Text(post.tglinsert,
                    style: new TextStyle(
                        fontSize: 12.0,
                        fontFamily: "Delicious",
                        color: Colors.grey)),
                new Padding(padding: new EdgeInsets.all(5.0)),
                new Text(post.judul,
                    style: new TextStyle(
                        fontSize: 20.0,
                        fontFamily: "Delicious",
                        color: Colors.black)),
                new Padding(padding: new EdgeInsets.all(5.0)),
                new Text(namapenulis,
                    style: new TextStyle(
                        fontSize: 12.0,
                        fontFamily: "Delicious",
                        color: Colors.grey)),
                new Padding(padding: new EdgeInsets.all(3.0)),
                new Text(
                  post.isipost,
                  style: new TextStyle(
                      fontSize: 12.0,
                      fontFamily: "Delicious",
                      color: Colors.grey),
                  overflow: TextOverflow.ellipsis,
                ),
                new Padding(padding: new EdgeInsets.all(5.0)),
              ],
            ),
          )),
    );
  }
}
