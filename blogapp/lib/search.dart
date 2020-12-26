import 'package:flutter/material.dart';

class Search extends StatefulWidget {
  @override
  _SearchState createState() => _SearchState();
}

class _SearchState extends State<Search> {
  String teks = "";
  @override
  Widget build(BuildContext context) {
    return Container(
      child: new TextField(
        decoration: new InputDecoration(
          hintText: "Search",
        ),
        onSubmitted: (String str) {
          setState(() {
            teks = str;
          });
        },
      ),
    );
  }
}