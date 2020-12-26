import 'package:blogapp/post.dart';
import 'package:flutter/material.dart';
import 'service.dart';

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
        for (Post p in _post) {
          Services.getNamaPenulis(p.idpenulis).then((namapenulis) {
            setState(() {
              _namapenulis.add(namapenulis);
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
                print("nama penulis $_namapenulis");
                return PreviewPost(_post[index], _namapenulis[index]);
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
            onPressed: () {},
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
