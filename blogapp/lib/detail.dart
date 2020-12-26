import 'package:flutter/material.dart';
import 'post.dart';
import 'service.dart';
import 'komentar.dart';

class Detail extends StatefulWidget {
  Post post;
  Detail(this.post);
  @override
  _DetailState createState() => _DetailState(post);
}

class _DetailState extends State<Detail> {
  Post post;
  List<Komentar> _komentar;
  String namapenulis;
  _DetailState(this.post);
  @override
  void initState() {
    super.initState();
    Services.getNamaPenulis(post.idpenulis).then((_namapenulis) {
      setState(() {
        namapenulis = _namapenulis;
      });
    });

    Services.getKomentar(post.idpost).then((komentar) {
      setState(() {
        _komentar = komentar;
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    print(_komentar);
    return Scaffold(
      backgroundColor: Colors.grey[100],
      appBar: new AppBar(
        backgroundColor: Colors.teal[300],
        title: new Center(
          child: new Text(this.post.judul),
        ),
      ),
      body: ListView(
        children: <Widget>[
          Center(child: Image.network(post.filegambar)),
          Padding(
              padding: const EdgeInsets.all(8.0),
              child: Padding(
                padding: const EdgeInsets.all(5.0),
                child: Card(
                  child: Column(
                    children: <Widget>[
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          post.tglinsert,
                          style: TextStyle(fontSize: 15),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          post.judul,
                          style: TextStyle(fontSize: 30),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          namapenulis,
                          style: TextStyle(fontSize: 15, color: Colors.grey),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          post.isipost,
                          style: TextStyle(color: Colors.black),
                        ),
                      )
                    ],
                  ),
                ),
              )),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: Text('Komentar',
                style: new TextStyle(
                    fontSize: 20.0,
                    fontFamily: "Delicious",
                    color: Colors.black)),
          ),
          ListView.builder(
              shrinkWrap: true,
              itemCount: _komentar == null ? 0 : _komentar.length,
              itemBuilder: (BuildContext context, int index) {
                return CardKomentar(_komentar[index]);
              })
        ],
      ),
    );
  }
}

class CardKomentar extends StatelessWidget {
  Komentar komentar;
  CardKomentar(this.komentar);
  @override
  Widget build(BuildContext context) {
    return Card(
        child: Column(mainAxisSize: MainAxisSize.min, children: <Widget>[
       Column(
         crossAxisAlignment:CrossAxisAlignment.end,
         children: [
           Padding(
             padding: const EdgeInsets.all(8.0),
             child: Text(komentar.tgl),
           ),
           ListTile(
            leading: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Icon(Icons.person),
            ),
            title: Text(komentar.nama),
            subtitle: Text(komentar.isi),
            
      ),
         ],
       )
    ]));
  }
}
