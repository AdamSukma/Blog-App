import 'package:flutter/material.dart';
import 'kategori.dart';
import 'search.dart';
import 'viewpost.dart';

void main() {
  runApp(new MaterialApp(
    home: new Home(),
  ));
}

class Home extends StatefulWidget {
  @override
  _HomeState createState() => _HomeState();
}

class _HomeState extends State<Home> with SingleTickerProviderStateMixin {
  TabController controller;

  @override
  void initState() {
    controller = new TabController(length: 3, vsync: this);
    super.initState();
  }

  @override
  void dispose() {
    controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[900],
      appBar: new AppBar(
        title: new Center(
          child: Text('UAS PBP Kelompok 7'),
        ),
        backgroundColor: Colors.teal[300],
        bottom: new TabBar(
          controller: controller,
          tabs: <Widget>[
            new Tab(
              icon: new Text("Post"),
            ),
            new Tab(
              icon: new Text("Kategori"),
            ),
            new Tab(
              icon: new Text("Search"),
            ),
          ],
        ),
      ),
      body: new TabBarView(
        controller: controller,
        children: <Widget>[
          ViewPost(),
          Kategori(),
          Search(),
        ],
      ),
    );
  }
}
