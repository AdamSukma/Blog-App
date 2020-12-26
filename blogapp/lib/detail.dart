import 'package:flutter/material.dart';

class Detail extends StatelessWidget {
  Detail(
      {this.judul,
      this.penulis,
      this.tanggal,
      this.gambar,
      this.isi,
      this.penuliskomentar,
      this.tglkomentar,
      this.isikomentar});
  final String judul;
  final String penulis;
  final String tanggal;
  final String gambar;
  final String isi;
  final String penuliskomentar;
  final String tglkomentar;
  final String isikomentar;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[900],
      appBar: new AppBar(
        backgroundColor: Colors.teal[300],
        leading: new Icon(Icons.home),
        title: new Center(
          child: new Text(judul),
        ),
      ),
      body: Column(
        children: <Widget>[
          Center(child: Image.asset(gambar)),
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
                          judul,
                          style:
                              TextStyle(fontSize: 24, fontFamily: "Delicious"),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          penulis,
                          style:
                              TextStyle(fontSize: 20, fontFamily: "Delicious"),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          tanggal,
                          style:
                              TextStyle(fontSize: 20, fontFamily: "Delicious"),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          isi,
                          style: TextStyle(
                              color: Colors.black, fontFamily: "Delicious"),
                        ),
                      )
                    ],
                  ),
                ),
              )),
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
                          penuliskomentar,
                          style:
                              TextStyle(fontSize: 20, fontFamily: "Delicious"),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          tglkomentar,
                          style:
                              TextStyle(fontSize: 20, fontFamily: "Delicious"),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Text(
                          isikomentar,
                          style: TextStyle(
                              color: Colors.black, fontFamily: "Delicious"),
                        ),
                      )
                    ],
                  ),
                ),
              ))
        ],
      ),
    );
  }
}
