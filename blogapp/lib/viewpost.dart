import 'package:blogapp/post.dart';
import 'package:flutter/material.dart';
import 'kategori.dart';
import 'kategori.dart';
import 'service.dart';
import 'detail.dart';
import 'kategori.dart';

class ViewPost extends StatefulWidget {
  @override
  _ViewPostState createState() => _ViewPostState();
}

class _ViewPostState extends State<ViewPost> {
  List<Post> _post;
  Map<String, String> _namapenulis = {};
  Kategori selectedKategori;
  List<Kategori> kategoris = [
    Kategori(name: 'Semua Kategori', idkategori: '0')
  ];
  List<DropdownMenuItem> generateItems(List<Kategori> kategoris) {
    List<DropdownMenuItem> items = [];
    for (var item in kategoris) {
      items.add(DropdownMenuItem(
        child: Text(item.name),
        value: item,
      ));
    }
    return items;
  }

  @override
  void initState() {
    super.initState();
    Services.getPost().then((post) {
      setState(() {
        _post = post;
        for (Post p in _post) {
          Services.getNamaPenulis(p.idpenulis).then((namapenulis) {
            setState(() {
              _namapenulis.addAll({p.idpost: namapenulis});
            });
          });
        }
      });
    });
    Services.getKategori().then((kategori) {
      setState(() {
        kategoris = kategoris + kategori;
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    return new Container(
      child: new Center(
          child: ListView(
        children: [
          TextField(
            decoration: new InputDecoration(
              hintText: "Search",
            ),
            onSubmitted: (String str) {
              Services.getPostByKeyword(str).then((post) {
                setState(() {
                  _post = post;
                });
              });
            },
          ),
          DropdownButton(
            isExpanded: true,
            style: TextStyle(color: Colors.blueGrey),
            value: selectedKategori,
            items: generateItems(kategoris),
            onChanged: (item) {
              selectedKategori = item;
              if (item.idkategori == 0) {
                Services.getPost().then((post) {
                  setState(() {
                    _post = post;
                  });
                });
              } else {
                Services.getPostByKategori(item.idkategori).then((post) {
                  setState(() {
                    _post = post;
                    print(post);
                  });
                });
              }
            },
          ),
          ListView.builder(
              shrinkWrap: true,
              physics: ScrollPhysics(),
              itemCount: _post == null ? 0 : _post.length,
              itemBuilder: (BuildContext context, int index) {
                return PreviewPost(
                    _post[index], _namapenulis[(_post[index].idpost)]);
              }),
        ],
      )),
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
                MaterialPageRoute(builder: (context) => Detail(post)),
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
