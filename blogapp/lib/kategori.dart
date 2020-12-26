import 'package:flutter/material.dart';

class Kategori extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Container(
      child: new ListView(
        children: <Widget>[
          new ListTile(
            title: new Text(
              "Komedi",
              style: new TextStyle(color: Colors.white),
            ),
          ),
          new ListTile(
            title: new Text(
              "Pemrograman",
              style: new TextStyle(color: Colors.white),
            ),
          ),
          new ListTile(
            title: new Text(
              "Edukasi",
              style: new TextStyle(color: Colors.white),
            ),
          ),
          new ListTile(
            title: new Text(
              "Fiksi",
              style: new TextStyle(color: Colors.white),
            ),
          ),
        ],
      ),
    );
  }
}